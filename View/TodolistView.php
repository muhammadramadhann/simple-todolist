<?php

namespace View {

    use Helper\InputHelper;
    use Service\TodolistService;

    class TodolistView
        {
        private TodolistService $todolistService;

        public function __construct(TodolistService $todolistService)
        {
            $this->todolistService = $todolistService;
        }

        function showTodolist(): void
        {
            echo "\nTODOLIST KAMU" . PHP_EOL;
            echo "--------------------------" . PHP_EOL;
            $this->todolistService->showTodolist();
        }

        function addTodolist(): void
        {
            echo "\nMenambah Todolist" . PHP_EOL;
            echo "---------------------" . PHP_EOL;

            $todo = InputHelper::input("Masukkan todolist [b untuk batal] : ");

            if ($todo == "b") {
                echo "Batal menambah todolist!" . PHP_EOL;
                echo "---------------------------------" . PHP_EOL;
                $this->showMenu();
            } else {
                $this->todolistService->addTodoList($todo);
            }
        }

        function removeTodolist(): void
        {
            echo "\nMenghapus Todolist" . PHP_EOL;
            echo "---------------------" . PHP_EOL;

            $this->todolistService->showTodolist();
            echo "------------------------------------------------" . PHP_EOL;

            $delete = InputHelper::input("Nomor todolist yang ingin dihapus [b untuk batal] : ");

            if ($delete == "b") {
                echo "Batal menghapus todolist!" . PHP_EOL;
                echo "---------------------------------" . PHP_EOL;
                $this->showMenu();
            } else {
                $this->todolistService->removeTodolist($delete);
            }
        }

        function showMenu(): void
        {
            $this->showTodolist();

            echo "\nMENU" . PHP_EOL;
            echo "--------------------------" . PHP_EOL;
            echo "1. Tambah Todo" . PHP_EOL;
            echo "2. Hapus Todo" . PHP_EOL;
            echo "x. Keluar" . PHP_EOL;
            echo "--------------------------" . PHP_EOL;

            $pilih = InputHelper::input("Pilih menu : ");

            if ($pilih == "1") {
                $this->addTodolist();
                $addMore = InputHelper::input("Tambah todolist lagi? [y/n] > ");
                echo "------------------------------------------------" . PHP_EOL;
                while (true)  {
                    if ($addMore == "y") {
                        $this->addTodolist();
                        $addMore = InputHelper::input("Tambah todolist lagi? [y/n] > ");
                        echo "------------------------------------------------" . PHP_EOL;
                    } else if ($addMore == "n") {
                        $this->showMenu();
                    } else {
                        echo "\nHanya menerima inputan y / n !\n" . PHP_EOL;
                        $addMore = InputHelper::input("Tambah todolist lagi? [y/n] > ");
                        echo "------------------------------------------------" . PHP_EOL;
                    }
                }
            } else if ($pilih == "2") {
                $this->removeTodolist();
                $deleteMore = InputHelper::input("Hapus todolist lagi? [y/n] > ");
                echo "------------------------------------------------" . PHP_EOL;
                while (true)  {
                    if ($deleteMore == "y") {
                        $this->removeTodolist();
                        $deleteMore = InputHelper::input("Hapus todolist lagi? [y/n] > ");
                        echo "------------------------------------------------" . PHP_EOL;
                    } else if ($deleteMore == "n") {
                        $this->showMenu();
                    } else {
                        echo "\nHanya menerima inputan y / n !\n" . PHP_EOL;
                        $deleteMore = InputHelper::input("Hapus todolist lagi? [y/n] > ");
                        echo "------------------------------------------------" . PHP_EOL;
                    }
                }
            } else if ($pilih == "x") {
                $checkOut = InputHelper::input("Yakin ingin keluar? [y/n] > ");
                echo "------------------------------------------------" . PHP_EOL;
                while (true) {
                    if ($checkOut == "n") {
                        $this->showMenu();
                    } else if ($checkOut == "y") {
                        echo "Terimakasih telah menggunakan program ini" . PHP_EOL;
                        echo "Sampai jumpa lagi..." . PHP_EOL;
                        echo "------------------------------------------------" . PHP_EOL;
                        exit;
                    } else {
                        echo "\nHanya menerima inputan y / n\n" . PHP_EOL;
                        $checkOut = InputHelper::input("Yakin ingin keluar? [y/n] > ");
                    }
                }
            } else {
                echo "--------------------------" . PHP_EOL;
                echo "\nHanya menerima inputan sesuai pilihan pada menu!" . PHP_EOL;
                $this->showMenu();
            }
        }
    }
}