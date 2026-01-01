<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reports extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $start = $this->request->getGet('start_date');
        $end = $this->request->getGet('end_date');

        $builder = $db->table('transactions')
            ->select('DATE(transaction_date) AS tgl, SUM(total_amount) AS total')
            ->whereIn('status', ['paid', 'completed']);

        if ($start && $end) {
            $builder->where('DATE(transaction_date) >=', $start)
                    ->where('DATE(transaction_date) <=', $end);
        }

        $builder->groupBy('DATE(transaction_date)');
        $chartData = $builder->get()->getResultArray();

        // Total pemasukan
        $income = array_sum(array_column($chartData, 'total'));

        // Total pengeluaran
        $expense = $db->table('expenses')
            ->selectSum('amount')
            ->get()->getRow()->amount ?? 0;

        $profit = $income - $expense;

        $data = [
            'income' => $income,
            'expense' => $expense,
            'profit' => $profit,
            'chartData' => $chartData,
            'start' => $start,
            'end' => $end
        ];

        return view('admin/reports/index', $data);
    }

    // ====================== EXPORT PDF ======================
    public function exportPdf()
    {
        $db = \Config\Database::connect();
        $transactions = $db->table('transactions')
            ->whereIn('status', ['paid', 'completed'])
            ->orderBy('transaction_date', 'DESC')
            ->get()->getResultArray();

        $html = view('admin/reports/pdf', ['transactions' => $transactions]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan_Keuangan_ChickenSizzle.pdf", ["Attachment" => true]);
    }

    // ====================== EXPORT EXCEL ======================
    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $transactions = $db->table('transactions')
            ->whereIn('status', ['paid', 'completed'])
            ->orderBy('transaction_date', 'DESC')
            ->get()->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Invoice');
        $sheet->setCellValue('C1', 'Total');
        $sheet->setCellValue('D1', 'Status');

        // Isi data
        $row = 2;
        foreach ($transactions as $t) {
            $sheet->setCellValue('A' . $row, $t['transaction_date']);
            $sheet->setCellValue('B' . $row, $t['invoice_number']);
            $sheet->setCellValue('C' . $row, $t['total_amount']);
            $sheet->setCellValue('D' . $row, $t['status']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Keuangan_ChickenSizzle.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
