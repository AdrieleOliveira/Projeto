@extends('layouts.app')
@section('content')
    <div class="container conteudo">
        <div class="card">
            <div class="card-header card-title">
                <img src="{{asset('img/icone.png')}}" alt="">
                <h5>Produtos</h5>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-lg-8 col-sm-6">
                        <input type="text"
                               list="products"
                               class="form-control"
                               autocomplete="on"
                               placeholder="Buscar">

                        <datalist id="products">
                            @foreach ($products as $product)
                                <option value="{{ $product['description'] }}">
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <button type="button" class="btn btn-block button-yellow" onclick="criar()">
                            <b>Novo Produto</b>
                        </button>
                    </div>
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
                            @if(count($products) == 0)
                                <tr>
                                    <td colspan="3">Nenhum item cadastrado</td>
                                </tr>
                            @else
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->description}}</td>
                                        <td>R$ {{number_format($product->price, 2, ',', '.')}}</td>
                                        <td>
                                            <a nohref class="icon-table" onclick="editar('{{$product->id}}')" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a nohref class="icon-table" onclick="remover('{{$product->id}}')" title="Remover">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="modalProduto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="formProduto">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastro de Produto</h5>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="id" class="form-control">
                            <input type="hidden" id="user" class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()}}">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label><b>Descrição</b></label>
                                        <input
                                            type="text"
                                            name="description"
                                            id="description"
                                            class="form-control"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label><b>Preço (R$)</b></label>
                                        <input
                                            type="number"
                                            name="price"
                                            id="price"
                                            class="form-control"
                                            step=".01"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-salvar btn-success">Salvar</button>
                            <button type="cancel" class="btn btn-cancelar btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        function criar() {
            $('#modalProduto').modal().find('.modal-title').text("Cadastro de Produto");
            $('#id').val('');
            $('#description').val('');
            $('#price').val('');
            $('#modalProduto').modal('show');
        }

        $('#formProduto').submit(function (event){
            event.preventDefault();

            let id = $('#id').val();

            if(id !== ''){
                console.log("update");
            } else {
                insert();
            }

            $('#modalProduto').modal('hide');
        });

        function insert(){
            let product = {
                description: $('#description').val(),
                price: $('#price').val(),
                user_id: $('#user').val()
            }

            console.log(product);

            $.post("api/produto", product, function (data){
                let line = getLin(data);
                $('#table>tbody').append(line);
            })
        }

        function getLin(product){
            let line;

            line = `<tr>`;
                line += `<td>${product.description}</td>`;
                line += `<td>${parseFloat(product.price).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}</td>`;
                line += `<td>
                            <a nohref class="icon-table" onclick="editar('${product.id}')" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a nohref class="icon-table" onclick="remover('${product.id}')" title="Remover">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>`;
            line += `</tr>`;

            return line;
        }
    </script>
@endsection
