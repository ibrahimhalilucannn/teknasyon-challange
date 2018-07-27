@extends('master')

@section('content')
    <div class="row gutter-xs">
        <div class="col-md-12 pull-right">
            <button class="btn btn-info btn-sm btn-labeled pull-right"  data-toggle="modal" data-target="#addModal" type="button">
                <span class="btn-label">
                  <span class="icon icon-plus icon-fw"></span>
                </span> Kullanıcı Ekle
            </button>
            <br>
            <br>
        </div>
    </div>
    <div class="row gutter-xs">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <strong>Kullanıcılar</strong>
                </div>
                <div class="card-body">
                    <table id="demo-datatables-fixedheader-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->surname}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if($item->role === 0)
                                        <span class="label label-default">Admin</span>
                                    @else
                                        <span class="label label-warning">Kullanıcı</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status === 0)
                                        <span class="label label-danger">Pasif</span>
                                    @else
                                        <span class="label label-warning">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon sq-24 editItem"  data-toggle="modal" data-target="#editModal-{{$item->id}}"> <span class="icon icon-pencil"></span> </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div id="addModal" tabindex="-1" role="dialog" class="modal fade" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Kullanıcı Ekle</h4>
                </div>
                <form data-toggle="validator" method="post" action="{{action('UserController@user_insert')}}" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" >Adı</label>
                                <input class="form-control" type="text" name="name" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Adı Giriniz.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Soyadı</label>
                                <input class="form-control" type="text" name="surname" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Soyadı Giriniz.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> Username </label>
                                <input class="form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Kullanıcı adını Giriniz.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen email adresinizi giriniz.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> Password </label>
                                <input  class="form-control" type="password" name="password" minlength="6"  data-rule-required="true" data-msg-minlength="Lütfen mesajınız 6 karakterden az olmamalı" data-msg-required="Lütfen şifrenizi giriniz">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group custom-controls-inline">
                                <label class="control-label">Status</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="custom-control custom-control-primary custom-radio">
                                            <input class="custom-control-input" type="radio" name="status" value="1"  spellcheck="false" autocomplete="off" data-rule-required="true"  data-msg-required="Lütfen Durumu giriniz.">
                                            <span class="custom-control-indicator"></span>
                                            <small class="custom-control-label">Aktif</small>
                                        </label>
                                        <label class="custom-control custom-control-danger custom-radio">
                                            <input class="custom-control-input" type="radio" name="status" value="0" spellcheck="false" autocomplete="off" data-rule-required="true"  data-msg-required="Lütfen Durumu giriniz.">
                                            <span class="custom-control-indicator"></span>
                                            <small class="custom-control-label">Pasif</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm btn-labeled" type="button" data-dismiss="modal">
                            <span class="btn-label">
                                <span class="icon icon-remove icon-lg icon-fw"></span>
                            </span>Kapat
                        </button>
                        <button class="btn btn-primary btn-sm btn-labeled" type="submit">
                            <span class="btn-label">
                                <span class="icon icon-check icon-lg icon-fw"></span>
                            </span>Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($items as $item)
        <div id="editModal-{{$item->id}}" tabindex="-1" role="dialog" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Kullanıcı Düzenle</h4>
                    </div>
                    <form data-toggle="validator" method="post" action="{{action('UserController@user_update',$item->id)}}" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" >Adı</label>
                                    <input class="form-control" type="text" name="name" value="{{$item->name}}" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Adı Giriniz.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Soyadı</label>
                                    <input class="form-control" type="text" name="surname" value="{{$item->surname}}" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Soyadı Giriniz.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"> Username </label>
                                    <input class="form-control" type="text" name="username" value="{{$item->username}}" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen Kullanıcı adını Giriniz.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$item->email}}" spellcheck="false" autocomplete="off" data-rule-required="true" data-msg-required="Lütfen email adresinizi giriniz.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group custom-controls-inline">
                                    <label class="control-label">Status</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="custom-control custom-control-primary custom-radio">
                                                <input class="custom-control-input" type="radio" name="status" value="1" {{ $item->status == '1' ? 'checked' : '' }} spellcheck="false" autocomplete="off" data-rule-required="true"  data-msg-required="Lütfen Durumu giriniz.">
                                                <span class="custom-control-indicator"></span>
                                                <small class="custom-control-label">Aktif</small>
                                            </label>
                                            <label class="custom-control custom-control-danger custom-radio">
                                                <input class="custom-control-input" type="radio" name="status" value="0" {{ $item->status == '0' ? 'checked' : '' }} spellcheck="false" autocomplete="off" data-rule-required="true"  data-msg-required="Lütfen Durumu giriniz.">
                                                <span class="custom-control-indicator"></span>
                                                <small class="custom-control-label">Pasif</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm btn-labeled" type="button" data-dismiss="modal">
                            <span class="btn-label">
                                <span class="icon icon-remove icon-lg icon-fw"></span>
                            </span>Kapat
                            </button>
                            <button class="btn btn-primary btn-sm btn-labeled" type="submit">
                            <span class="btn-label">
                                <span class="icon icon-check icon-lg icon-fw"></span>
                            </span>Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection