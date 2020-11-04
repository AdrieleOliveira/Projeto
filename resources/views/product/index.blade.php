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
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-block button-blue" onclick="criar()">
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
                            @foreach($products as $product)
                                <tr id="{{$product->id}}">
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

        <div class="modal" tabindex="-1" role="dialog" id="modalRemove">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" id="formRemove">
                        <div class="modal-header">
                            <h5 class="modal-title">Remoção de Produto</h5>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="id_remove" class="form-control">

                            Deseja realmente remover o produto?
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-salvar btn-success">Sim</button>
                            <button type="cancel" class="btn btn-cancelar btn-secondary" data-dismiss="modal">Não</button>
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

        function editar(id){
            $.getJSON('/api/produto/' + id, function (data){
                $('#id').val(data.id);
                $('#description').val(data.description);
                $('#price').val(parseFloat(data.price).toFixed(2));

                $('#modalProduto').modal().find('.modal-title').text("Alteração de Produto");
                $('#modalProduto').modal('show');
            });
        }

        function remover(id){
            $('#modalRemove').modal('show');

            $('#id_remove').val(id);
        }

        $('#formRemove').submit(function (event){
            event.preventDefault();

            let id = $('#id_remove').val();

            $.ajax({
                type: "DELETE",
                url: "/api/produto/" + id,
                context: this,
                success: function (){
                    $(`#${id}`).remove();
                }
            })

            $('#modalRemove').modal('hide');
        })

        $('#formProduto').submit(function (event){
            event.preventDefault();

            let id = $('#id').val();

            if(id !== ''){
                update(id);
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

            $.post("api/produto", product, function (data){
                let line = getLin(data);
                $('#table>tbody').append(line);
            })
        }

        function update(id){
            let product = {
                description: $('#description').val(),
                price: $('#price').val(),
            }

            $.ajax({
                type: "PUT",
                url: "/api/produto/" + id,
                context: this,
                data: product,
                success: function (){
                    let linha = $(`#${id}`);

                    if(linha){
                        linha[0].cells[0].textContent = product.description;
                        linha[0].cells[1].textContent = parseFloat(product.price).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
                    }
                }
            })
        }

        function getLin(product){
            let line;

            line = `<tr id="${product.id}">`;
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
