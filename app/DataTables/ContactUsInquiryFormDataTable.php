<?php

namespace App\DataTables;

use App\Models\ContactUsFormInquiry;
use App\Models\ContactUsInquiryForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactUsInquiryFormDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('phone', fn($contactForm) => $contactForm->phone ?? '-')

            ->editColumn(
                'state',
                fn($contactForm) =>
                $contactForm->state?->name ?? '-'
            )
            ->editColumn(
                'city',
                fn($contactForm) =>
                $contactForm->city?->name ?? '-'
            )

            ->editColumn('created_at', fn($contactForm) => Carbon::parse($contactForm->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($contactForm) => $contactForm->updated_at ? Carbon::parse($contactForm->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'contact_us_form_inquiries.created_at $1')
            ->orderColumn('updated_at', 'contact_us_form_inquiries.updated_at $1')

            ->addColumn('action', fn($contactForm) => view('pages.contact_us._actions', compact('contactForm'))->render())
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ContactUsFormInquiry $model): QueryBuilder
    {
        return $model->newQuery()->with(['state', 'city']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('contactusinquiryform-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(7, 'desc')
            ->addTableClass('table table-striped table-row-bordered gy-5 gs-7 border rounded text-gray-700 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback(
                "function() {
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }"
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Phone'),
            Column::make('state')->title('State'),
            Column::make('city')->title('City'),
            Column::make('service')->title('Service'),
            Column::make('message')->title('Message'),

            Column::make('created_at')->title('Created At'),

            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ContactUsInquiryForm_' . date('YmdHis');
    }
}
