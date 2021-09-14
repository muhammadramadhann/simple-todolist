<?php

namespace Repository {

    use Entity\Todolist;

    interface TodolistRepository
    {
        function returnAll(): array;

        function save(Todolist $todolist): void;

        function remove(int $number): bool;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {
        public array $todolist = [];

        function returnAll(): array
        {
            return $this->todolist;
        }
        
        function save(Todolist $todolist): void
        {
            $number = sizeof($this->todolist) + 1;
            $this->todolist[$number] = $todolist;
        }

        function remove(int $number): bool
        {
            if ($number > sizeof($this->todolist)) {
                return false;
            }

            for ($x = $number; $x < sizeof($this->todolist); $x++) {
                $this->todolist[$x] = $this->todolist[$x + 1];
            }

            unset($this->todolist[sizeof($this->todolist)]);

            return true;
        }
    }
}