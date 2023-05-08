<?php

namespace Service{

use Entity\Tagihan;
use Repository\TagihanRepository;

    interface TagihanService {
        public function addTagihan(Tagihan $tagihan);
        public function findTagihanById($id);
        public function updateTagihan(Tagihan $tagihan);
        public function deleteTagihanById($id);
        public function showTagihan();
    }
    class TagihanServiceImpl implements TagihanService
        {
                private TagihanRepository $tagihanRepository;

                public function __construct(TagihanRepository $tagihanRepository)
                {
                    $this->tagihanRepository = $tagihanRepository;
                }


        public function addTagihan(Tagihan $tagihan)
        {
            // Check if the id_siswa and id_spp properties of the Tagihan object exist
            if ($tagihan->getIdSiswa() && $tagihan->getIdSpp()) {
                // Call the addTagihan() method of the TagihanRepository object to add the Tagihan object to the database
                $this->tagihanRepository->addTagihan($tagihan);
            } else {

            }
        }

            public function findTagihanById($id) {
                return $this->tagihanRepository->findTagihanById($id);
            }

            public function updateTagihan(Tagihan $tagihan) {
                $this->tagihanRepository->updateTagihan($tagihan);
            }

            public function deleteTagihanById($id) {
                $this->tagihanRepository->deleteTagihanById($id);
            }

            public function showTagihan() {
                return $this->tagihanRepository->showTagihan();
            }
        }
    }