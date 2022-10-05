<?php

namespace App\DataTables;

use App\Models\Number;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NumbersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function ($row){
                return !empty($row->created_at) ? date('Y-m-d', strtotime($row->created_at)) : 'N/A';
            })
            ->editColumn('is_whitelist', function ($row){
                if ($row->is_whitelist == true){
                    return '<span class="badge bg-success">Yes</span>';
                }
                return '<span class="badge bg-warning">No</span>';
            })
            ->addColumn('action', function ($row) {
                return '<div style="display:inline-flex;">
                    <a href="'.route('numbers.change.status', $row->id).'" class="btn me-2 btn-sm btn-dark changeStatus"><i class="bx bx-filter-alt"></i></a>
                    <a href="'.route('numbers.preview', $row->id).'" class="btn me-2 btn-sm btn-warning previewBtn"><i class="bx bx-edit"></i></a>
                    <a href="'.route('numbers.delete', $row->id).'" class="btn btn-sm btn-danger deleteNumber"><i class="bx bx-trash"></i></a>
                ';

            })
            ->rawColumns(['action', 'is_whitelist'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NumbersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Number::query()->orderBy('id', 'desc');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('number'),
            Column::make('is_whitelist')->title('Whitelisted'),
            Column::make('created_at')->title('Date Created'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Numbers_' . date('YmdHis');
    }
}
