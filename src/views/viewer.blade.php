@extends('syntara::layouts.dashboard.master')

@section('content')
<link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara-logviewer/assets/css/logs.css') }}" />

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills">
                <li class="{{ Request::segment(6) === null || Request::segment(6) === 'all' ? 'active' : ''}}"><a href="{{ Request::root() }}/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/all' }}">All</a></li>
                @foreach ($levels as $level)
                    <li class="{{ Request::segment(6) === $level ? 'active' : '' }}"><a href="{{ Request::root() }}/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/' . $level }}">{{ ucfirst(Lang::get('logviewer::logviewer.levels.' . $level)) }}</a></li>
                @endforeach
                @if(!$empty)
                <li class="pull-right">
                    <button data-toggle="modal" data-target="#confirm-modal" id="btn-delete" type="button" class="btn btn-danger">Delete current log</button>
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
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ lcfirst($files['sapi']) }}">
                                    {{ ($count > 1 ? $app . ' - ' . $files['sapi'] : $files['sapi']) }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-{{ lcfirst($files['sapi']) }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav nav-list">
                                        @foreach ($file as $f)
                                             <li class="list-group-item">
                                                <a href="{{ Request::root() }}/{{ $url . '/' . $app . '/' . $type . '/' . $f }} ">{{ $f }}</a>
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
        <div class="col-lg-10">
            <div class="{{ ! $has_messages ? ' hidden' : '' }}">
                <div class="col-lg-12" id="messages">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('info'))
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ Session::get('info') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{ $paginator->links() }}
                    <div id="log" class="well">
                        @if(!$empty && !empty($log))
                            <?php $c = 1; ?>
                            @foreach($log as $l)
                                <div class="alert">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="log log-{{ $l['level'] }}">
                                                <h4 class="panel-title">
                                                    @if($l['stack'] !== "\n")
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $c }}" >
                                                    @endif
                                                    {{ $l['header'] }}
                                                    </a>
                                                </h4>
                                            </div>
                                            @if($l['stack'] !== "\n")
                                            <div id="collapse-{{ $c }}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <pre>
                                                        {{ $l['stack'] }}
                                                    </pre>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php $c++; ?>
                            @endforeach
                        @elseif(!$empty && empty($log))
                            <div class="alert alert-info">
                                {{ Lang::get('logviewer::logviewer.empty_file', array('sapi' => $sapi, 'date' => $date)) }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                {{ Lang::get('logviewer::logviewer.no_log', array('sapi' => $sapi, 'date' => $date)) }}
                            </div>
                        @endif
                    </div>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this log?</p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-default" data-dismiss="modal">No</a>
                <a href="{{ Request::root() }}/{{$url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/delete' }}" type="button" class="btn btn-primary" >Yes</a>
            </div>
        </div>
    </div>
</div>
@stop
