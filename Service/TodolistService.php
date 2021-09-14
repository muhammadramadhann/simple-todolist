<?php

namespace Service {

    use Entity\Todolist;
    use Repository\TodolistRepository;

    interface TodolistService
    {
        public function showTodolist(): void;

        public function addTodolist(string $todo): void;

        public function removeTodolist(int $number): void;
    }

    class TodolistServiceImpl implements TodolistService
    {

        private TodolistRepository $todolistRepository;

        public function __construct(TodolistRepository $todolistRepository)
        {
            $this->todolistRepository = $todolistRepository;
        }

        public function showTodolist(): void
        {
            $todolist = $this->todolistRepository->returnAll();
            if (sizeof($todolist) == 0) {
                echo "- Todolist masih kosong -" . PHP_EOL;
            } else {
                foreach ($todolist as $number => $value) {
                    echo "$number. " . $value->getTodo() . PHP_EOL;
                }
            }
        }

        public function addTodolist(string $todo): void
        {
            $todolist = new Todolist($todo);
            $this->todolistRepository->save($todolist);
            echo "Berhasil menambah {$todolist->getTodo()} kedalam todolist!" . PHP_EOL;
            echo "------------------------------------------------" . PHP_EOL;
        }

        public function removeTodolist(int $number): void
        {
            if ($this->todolistRepository->remove($number)) {
                echo "Todolist nomor $number berhasil dihapus!" . PHP_EOL;
                echo "------------------------------------------------" . PHP_EOL;
            } else {
                echo "------------------------------------------------------------------------------------------" . PHP_EOL;
                echo "Todolist gagal dihapus!, coba cek nomor todolist yang diinput atau restart program" . PHP_EOL;
                echo "-------------------------------------------------------------------------------------------" . PHP_EOL;
            }
        }
    }
}