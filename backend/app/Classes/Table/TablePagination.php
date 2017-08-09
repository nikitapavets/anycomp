<?php

namespace App\Classes\Table;

class TablePagination
{
    private $total;
    private $lastPage;
    private $perPage;
    private $currentPage;
    private $currentPageUrl;
    private $previousPageUrl;
    private $nextPageUrl;
    private $lastPageUrl;
    private $firstPageUrl;
    private $paginator;

    function __construct($paginator)
    {
        $this->paginator = $paginator;
        $this->perPage = $paginator->perPage();
        $this->lastPage = $paginator->lastPage();
        $this->currentPage = $paginator->currentPage();
        $this->total = $paginator->total();
        $this->lastPageUrl = $paginator->url($paginator->lastPage());
        $this->previousPageUrl = $paginator->previousPageUrl();
        $this->nextPageUrl = $paginator->nextPageUrl();
        $this->currentPageUrl = $paginator->url($paginator->currentPage());
        $this->firstPageUrl = $paginator->url(1);
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;
    }

    public function getLastPage()
    {
        return $this->lastPage;
    }

    public function getRange()
    {
        $lastPageItem = $this->getCurrentPage() * $this->getPerPage();
        $firstPageItem = $lastPageItem - $this->getPerPage() + 1;
        $lastPageItem = $lastPageItem < $this->total ? $lastPageItem : $this->total;
        return $firstPageItem . '-' . $lastPageItem;
    }

    public function getPageNumbers()
    {
        $pages = [];
        for ($pageIndex = 1; $pageIndex <= $this->lastPage; $pageIndex++)
        {
            $page = [
                'index' => $pageIndex,
                'current' => $pageIndex == $this->currentPage ? true : false,
                'path' => $this->paginator->url($pageIndex)
            ];
            $pages[] = $page;
        }

        if(count($pages) > 5) {
            $offset = $this->currentPage - 3;
            if($offset > $this->lastPage - 5) {
                $offset = $this->lastPage - 5;
            }
            if($offset < 0) {
                $offset = 0;
            }
            $pages = array_slice($pages,$offset , 5);
        }
        return $pages;
    }

    public function toArray()
    {
        return [
            'total' => $this->total,
            'perPage' => $this->perPage,
            'lastPage' => $this->lastPage,
            'currentPage' => $this->currentPage,
            'range' => $this->getRange(),
            'currentPageUrl' => $this->currentPageUrl,
            'previousPageUrl' => $this->previousPageUrl,
            'nextPageUrl' => $this->nextPageUrl,
            'lastPageUrl' => $this->lastPageUrl,
            'firstPageUrl' => $this->firstPageUrl,
            'pageNumbers' => $this->getPageNumbers()
        ];
    }
}