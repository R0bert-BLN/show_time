<?php

namespace App\Service;

use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Writer\PngWriter;
use TCPDF;

class QrCodeService
{
    public function __construct(private BuilderInterface $qrBuilder) {}

    public function generateQrCode(string $data): string
    {
        $result = $this->qrBuilder
            ->data($data)
            ->size(200)
            ->margin(10)
            ->writer(new PngWriter())
            ->build();

        $fileName = uniqid('qr_', true) . '.png';
        $filePath = sys_get_temp_dir() . '/' . $fileName;
        file_put_contents($filePath, $result->getString());

        return $filePath;
    }

    public function generatePdfWithQrCodes(array $qrPaths): string
    {
        $pdf = new TCPDF();
        $pdf->AddPage();

        $x = 15;
        $y = 20;
        foreach ($qrPaths as $i => $qrPath) {
            if ($i > 0 && $i % 4 == 0) {
                $pdf->AddPage();
                $x = 15;
                $y = 20;
            }

            $pdf->Image($qrPath, $x, $y, 50, 50);
            $y += 60;
        }

        $pdfPath = sys_get_temp_dir() . '/' . uniqid('qrs_', true) . '.pdf';
        $pdf->Output($pdfPath, 'F');

        return $pdfPath;
    }
}
