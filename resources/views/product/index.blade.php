@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="title">
                <img src="{{asset('img/image1.png')}}">
                <h5>Produtos</h5>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end">
                        <a class="btn btn-block button-plus" onclick="criar()">
                            <b><i class="fas fa-plus"></i></b>
                        </a>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table">
                                <thead class="">
                                <tr>
                                    <th>Item</th>
                                    <th>Preço</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                </tr>
                                <tr>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                </tr>
                                <tr>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                    <td>aasa</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

