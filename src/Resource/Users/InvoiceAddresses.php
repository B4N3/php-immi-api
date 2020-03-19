<?php


namespace Imper86\ImmiApi\Resource\Users;


use Imper86\ImmiApi\Resource\AbstractResource;
use Imper86\ImmiApi\Resource\DeleteTrait;
use Imper86\ImmiApi\Resource\GetTrait;
use Imper86\ImmiApi\Resource\PostTrait;
use Imper86\ImmiApi\Resource\PutTrait;

class InvoiceAddresses extends AbstractResource
{
    use GetTrait, PostTrait, PutTrait, DeleteTrait;

    protected function getBaseUri(): string
    {
        return '/user_invoice_addresses';
    }
}