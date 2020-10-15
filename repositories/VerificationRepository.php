<?php


namespace app\repositories;


class VerificationRepository extends Repository
{

    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityName(): string
    {
        return VerificationRepository::class;
    }
}