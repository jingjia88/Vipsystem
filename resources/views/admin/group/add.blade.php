@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ URL::asset('css/checkbox.js') }}"></script>
<div class="container"  style="margin-left: 100px; ">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-default"  >
                <div class="panel-body">
                    <a href="{{ url('admin') }}" class="btn btn-lg btn-success col-xs-12">會員管理</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('admin/group') }}" class="btn btn-lg btn-success col-xs-12">群組管理</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('admin/mail') }}" class="btn btn-lg btn-success col-xs-12">寄送通知</a>
                </div>
                <!-- <div class="panel-body">
                    <a href="{{ url('admin/reply') }}" class="btn btn-lg btn-success col-xs-12">回覆管理</a>
                </div> -->
            </div>
        </div>
    <div class="col-md-8 col-md-offset">
    
    <h2> 新增群組 </h2> 
    
    <div class="panel panel-default"  >
        <div class="panel-body">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>新增失败</strong> 输入不符合要求<br><br>
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif

            <h4>會員搜索：</h4>
            <input type="search" id="search" style="width:500px" name="q" required="required" placeholder="Search..." />
            <button id="query" onclick="search();" class="btn btn-lg btn-info">搜索</button>
            <button onclick="show_all();" class="btn btn-lg btn-info">all</button>
            
            <form action="{{ url('admin/group') }}" id="member_form" method="POST">
                {!! csrf_field() !!}
                <h4>群組名稱：</h4>
                <input type="text" name="name" class="form-control" required="required">
                
                <h4>會員名單：</h4>
                <table id="mytable" style="line-height:40px;" border="2" >
                  <tr id="table_title">
                    <th scope="col" style="width:100px"></th>
                    <th scope="col" style="width:30px">ID</th>
                    <th scope="col" style="width:60px">姓名</th>
                    <th scope="col" style="width:60px">電話號碼</th>
                    <th scope="col" style="width:100px">職位</th>
                    <th scope="col" style="width:250px">email</th>
                    <th scope="col" style="width:150px">公司</th>
                  </tr>
                  @foreach ($members as $member)
                  <tr name="{{ $member->name }}">
                    <td><input type="checkbox" value="{{$member->id}}"  name="member[]"> 
                    </td>
                    
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->identity }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->company }}<td>
                  </tr>
                  @endforeach
                </table>
                <br>
                <button class="btn btn-lg btn-info" onclick="return onSubmit()">新增</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<script language="javascript">
function onSubmit() 
{ 
    var fields = $("input[name='member[]']").serializeArray(); 
    if (fields.length === 0) 
    { 
        alert('請至少勾選一位會員'); 
        // cancel submit
        return false;
    }
    return true;
}

// register event on form, not submit button
$('#member_form').submit(onSubmit)

function search(){
    show_all();
    let q = document.getElementById('search').value;
    let ele = document.getElementById('mytable').getElementsByTagName('tr');
    for(let i=1; i<ele.length; i++){
        if( ele[i].getAttribute("name").search(q)==-1){
            ele[i].style.display = 'none';
        }
    }
}

function show_all(){
    let ele = document.getElementById('mytable').getElementsByTagName('tr');
    console.log(ele);
    for(let i=1; i<ele.length; i++){
        ele[i].style.display = 'table-row';
    }
}

</script>


@endsection