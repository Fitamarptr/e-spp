<?php

namespace View {

    use Service\SppService;
    use Helper\InputHelper;
    use Entity\Spp;

    class SppView
    {

        private SppService $sppService;

        public function __construct(SppService $sppService)
        {
            $this->sppService = $sppService;
        }

        function showSpp(): void
        {
            while (true) {
                $this->sppService->showSpp();

                echo "MENU" . PHP_EOL;
                echo "1. Tambah SPP" . PHP_EOL;
                echo "2. Hapus SPP" . PHP_EOL;
                echo "3. Edit SPP" . PHP_EOL;
                echo "x. Keluar" . PHP_EOL;

                $pilihan = InputHelper::input("Pilih");

                if ($pilihan == "1") {
                    $this->addSpp();
                } else if ($pilihan == "2") {
                    $this->removeSpp();
                } else if ($pilihan == "3") {
                    $pilihan = InputHelper::input("Masukkan ID (x untuk batalkan)");
                    if ($pilihan == "x") {
                        echo "Batal mengedit Spp" . PHP_EOL;
                    } else {
                        $this->updateSpp($pilihan);
                    }

                } else if ($pilihan == "x") {
                    break;
                } else {
                    echo "Pilihan tidak dimengerti" . PHP_EOL;
                }
            }

            echo "Sampai Jumpa Lagi" . PHP_EOL;
        }

        function addSpp(): void
        {
            echo "MENAMBAH SPP" . PHP_EOL;

            $spp = InputHelper::input("Spp (x untuk batal)");
            $bulan = InputHelper::input("Bulan (x untuk batal)");
            $status = InputHelper::input("Status (x untuk batal)");

            if ($spp == "x") {
                echo "Batal menambah Spp" . PHP_EOL;
            } else {
                $this->sppService->addSpp($spp, $bulan, $status);
            }
        }

        function removeSpp(): void
        {
            echo "MENGHAPUS SPP" . PHP_EOL;

            $pilihan = InputHelper::input("Nomor (x untuk batalkan)");

            if ($pilihan == "x") {
                echo "Batal menghapus Spp" . PHP_EOL;
            } else {
                $this->sppService->removeSpp($pilihan);
            }
        }

//        function updateSpp($pilihan): void
//        {
//            $spp = $this->sppService->getSppById($pilihan);
//            if ($spp) {
//                $newSpp = [
//                    'spp' => InputHelper::input("Masukkan Nominal Spp (" . $spp->getSpp() . " untuk tidak mengubah)"),
//                    'bulan' => InputHelper::input("Masukkan Bulan (" . $spp->getBulan() . " untuk tidak mengubah)"),
//                    'status' => InputHelper::input("Masukkan Status (" . $spp->getStatus() . " untuk tidak mengubah)"),
//                ];
//                $this->sppService->updateSpp($pilihan, $newSpp['spp'], $newSpp['bulan'], $newSpp['status']);
//            } else {
//                echo "Spp dengan ID $pilihan tidak ditemukan" . PHP_EOL;
//            }
//        }


    }

}
