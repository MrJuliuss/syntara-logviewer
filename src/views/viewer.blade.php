@extends('syntara::layouts.dashboard.master')

@section('content')
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills">
                <li class="active"><a href="/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/all' }}">All</a></li>
                @foreach ($levels as $level)
                    <li><a href="/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/' . $level }}">{{ ucfirst(Lang::get('logviewer::logviewer.levels.' . $level)) }}</a></li>
                @endforeach
                @if(!$empty)
                <li class="pull-right">
                    <button data-toggle="modal" data-target="delete_modal" id="delete_modal" type="button" class="btn btn-danger">Delete current log</button>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
        @if($logs)
        <div class="panel-group" id="accordion">
            @foreach ($logs as $type => $files)
            <?php $count = count($files['logs']) ?>
                @foreach ($files['logs'] as $app => $file)
                    @if(!empty($file))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    {{ ($count > 1 ? $app . ' - ' . $files['sapi'] : $files['sapi']) }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="nav nav-list">
                                        @foreach ($file as $f)
                                             <li class="list-group-item">
                                                <a href="/{{ $url . '/' . $app . '/' . $type . '/' . $f }} ">{{ $f }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        @endif
        </div>
        <div class="col-lg-10"></div>
    </div>
</div>
@stop