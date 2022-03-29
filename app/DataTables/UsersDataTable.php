<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                $image = !empty($row->profile_photo_path) ? $row->profile_photo_path : 'uploads/default.jpg';
                return '<img src="' . env('APP_URL') . $image . '" height="100" width="100">';
            })
            ->addColumn('dob', function ($row) {
                return $row->dob ? date('j-F-Y', strtotime($row->dob)) : '-';
            })
            ->addColumn('age', function ($row) {
                return $row->age;
            })
            ->addColumn('mobile_phone', function ($row) {
                return $row->mobile_phone;
            })
            ->addColumn('street_address', function ($row) {
                return $row->street_address;
            })
            ->addColumn('city', function ($row) {
                return $row->city;
            })
            ->addColumn('state', function ($row) {
                return $row->state;
            })
            ->addColumn('zip_code', function ($row) {
                return $row->zip_code;
            })
            ->addColumn('current_time', function ($row) {
                return $row->current_time;
            })
            ->addColumn('action', function ($row) {
                $html = '';
                $html .= '<a href="'.route('users.edit',[$row->id]).'" class="btn btn-round btn-sm btn-warning btn-just-icon"
                        title="Edit">Edit</a> | ';
                $html .= '<a href="javascript:;" class="btn btn-danger btn-round btn-sm btn-just-icon delete-user"
                        data-user-id="' . $row->id . '" title="Delete">Delete</a>';

                return $html;
            })
            ->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <label class="form-check-label">
                                <input class="user-check" type="checkbox" value="' . $row->id . '">
                                <span class="form-check-sign">
                                <span class="check"></span>
                                </span>
                            </label>
						</div>';
            })
            ->rawColumns(['image', 'action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UsersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->orderBy(1)
            ->lengthMenu([5,10,15])
            ->parameters();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $checkbox = '<div class="form-check">
							<label class="form-check-label">
								<input class="check-uncheck-all" type="checkbox">
								<span class="form-check-sign">
								<span class="check"></span>
								</span>
							</label>
					</div>';
        return [
            Column::computed('checkbox',$checkbox)->orderable(false)->width('10%'),
            Column::computed('#')->orderable(false)->width('5%'),
            Column::make('first_name')->width('15%'),
            Column::make('last_name')->width('15%'),
            Column::make('email')->width('25%'),
            Column::make('image')->width('15%'),
            Column::make('dob')->width('25%'),
            Column::make('age')->width('5%'),
            Column::make('mobile_phone')->width('15%'),
            Column::make('street_address')->width('25%'),
            Column::make('city')->width('10%'),
            Column::make('state')->width('10%'),
            Column::make('zip_code')->width('5%'),
            Column::make('current_time')->width('5%'),
            Column::computed('action')->width('25%')->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
