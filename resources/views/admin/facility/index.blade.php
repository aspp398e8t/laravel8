@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection
<style>
    .th.td{
        align-content: center;
    }
</style>

@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="card-header">設施介紹管理</h2>
                <div class="form-group pt-4 px-3 m-0">
                    <a href="{{route('facility.create')}}" class="btn btn-success">新增設施</a>
                </div>
                <hr>
                <div class="card-body">
                    <table id="my-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th width="250">圖片</th>
                                <th width="200">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                            <tr>        
                                    <td>{{$facility->title}}</td>
                                    
                                    <td><img src="{{Storage::url($facility->image_url)}}" alt="" width="200"></td>
                                    <td>
                                        <a href="{{route('facility.edit',['id'=>$facility -> id])}}" class="btn btn-primary">編輯</a>
                                        <button class="btn btn-danger delete-btn">刪除</button>
                                        <form class="d-none" action="{{route('facility.destroy',['id'=>$facility -> id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#my-table').DataTable({
                "order": []
            });
    });

    const deleteElements = document.querySelectorAll('.delete-btn');
    deleteElements.forEach(function (deleteElement) {
        deleteElement.addEventListener('click',function () {
            if (confirm('你確定要刪除資料嗎?')){
                this.nextElementSibling.submit();
            }
        });
    
        
    });
</script>
@endsection