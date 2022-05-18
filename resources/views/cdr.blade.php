<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 font-weight-bold">
            {{ __('CDR - Xorcom CXTS4000') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Reporte de Llamadas</h5>
                    <hr>
                    <form class="form-horizontal" data-parsley-validate role="form" method="POST" action="{{route('report.cdr_search_details')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xxl-4 mb-3 d-flex">
                                <label class="col-form-label pe-2" for="inputInlineUsername">Desde</label>
                                <input name="form_fecha1" type="date" class="form-control" value="{{ $fechas['fecha1'] }}" required>
                            </div>
                            <div class="col-xxl-4 mb-3 d-flex">
                                <label class="col-form-label pe-2" for="inputInlinePassword">Hasta</label>
                                <input name="form_fecha2" type="date" class="form-control" value="{{ $fechas['fecha2'] }}" required>
                            </div>
                            <div class="col-xxl-4 mb-3 d-flex">
                                <button type="submit" class="btn btn-block btn-primary">Buscar Registros</button>
                            </div>
                        </div>

                    </form>
                    <hr>
                    <table id="DBRegistros" class="table table-sm table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Fecha</th>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Minutos</th>
                                <th>Estado</th>
                                <th>Descarga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_null($registros))
                            @else
                            @foreach ($registros as $cdr)
                                <tr>
                                    <td class=" ">{{ $cdr->calldate }}</td>
                                    <td class=" ">{{ $cdr->source }}</td>
                                    <td class=" ">{{ $cdr->destination }}</td>
                                    <td class=" ">{{ $cdr->duration }}</td>
                                    <td class=" ">{{ $cdr->disposition }}</td>
                                    <td class=" "></td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $('#DBRegistros').DataTable({
            order: [],
            language: {
                "url": "http://" + jQuery(location).attr('host') + "/js/Spanish.json",
                buttons: {
                    pageLength: {
                        _: "Ver %d Registros",
                        '-1': "Todos"
                    }
                }
            },
            pageLength : 20,
            lengthMenu: [[10, 20, 30, 40, 50, -1], ['10 Registros', '20 Registros', '30 Registros', '40 Registros', '50 Registros', 'Todos']],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6,7 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6,7 ]
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                                '<img src="" style="position:absolute; top:0; left:0;" />'
                            );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size','5px', 'inherit' );
                    }
                },
            ]
        });
    </script>
    @endpush
</x-app-layout>
