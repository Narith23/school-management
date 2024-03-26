<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            @if (isset($dataTable))
                                @foreach ($dataTable as $item)
                                    <th>{{ $item['label'] }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($objects) && count($objects) > 0)
                            @foreach ($objects as $object)
                                <tr>
                                    @foreach ($dataTable as $item)
                                        <td style="vertical-align: middle!important;">
                                            @if ($item['type'] === 'text')
                                                @if (isset($item['format']) && $item['format'] === 'currency')
                                                    {{ number_format($object->{$item['name']}, 2, '.', ' ') }}
                                                @else
                                                    {{ $object->{$item['name']} }}
                                                @endif
                                            @elseif ($item['type'] === 'datetime')
                                                @if (!empty($object->{$item['name']}))
                                                    @php
                                                        $dataFormat = new DateTime($object->{$item['name']});
                                                        $dataFormat = $dataFormat->format('d M Y h:i:s A');
                                                    @endphp
                                                    {{ $dataFormat }}
                                                @else
                                                    N/A
                                                @endif
                                            @elseif ($item['type'] === 'date')
                                                @php
                                                    if (!empty($object->{$item['name']})) {
                                                        $dataFormat = new DateTime($object->{$item['name']});
                                                        $dataFormat = $dataFormat->format('d M Y');
                                                    } else {
                                                        $dataFormat = 'N/A';
                                                    }
                                                @endphp
                                                {{ $dataFormat }}
                                            @elseif ($item['type'] === 'file:image')
                                                <img src="{{ $object->{$item['name']} ? asset($object->{$item['name']}) : asset('images/placeholder/placeholder.png') }}"
                                                    width="{{ $object->{$item['width']} ?? '100' }}"
                                                    alt="{{ $object->{$item['name']} }}"
                                                    class="img-fluid img-thumbnail rounded">
                                            @elseif ($item['type'] === 'html:bool')
                                                @if ($object->{$item['name']})
                                                    <span class="badge text-success">{{ $item['text']['true'] }}</span>
                                                @else
                                                    <span class="badge text-danger">{{ $item['text']['false'] }}</span>
                                                @endif
                                            @elseif ($item['type'] === 'relation')
                                                @if ($item['relation']['type'] === 'badge')
                                                    @php
                                                        $val = $object->{$item['name']};
                                                        if ($val !== null && $val !== '' && $val !== 0) {
                                                            $dataVal = $item['relation']['model']::find($val);
                                                        } else {
                                                            $dataVal = 'No Data';
                                                        }
                                                    @endphp
                                                    <span class="badge"
                                                        style="background-color: {{ $dataVal['color'] }}; color: #000">
                                                        {{ $dataVal[$item['relation']['attribute']] }}</span>
                                                @elseif ($item['relation']['type'] === 'text')
                                                    @php
                                                        $val = $object->{$item['name']};
                                                        if ($val !== null && $val !== '' && $val !== 0) {
                                                            $dataVal = $item['relation']['model']::find($val);
                                                        } else {
                                                            $dataVal = 'No Data';
                                                        }
                                                    @endphp
                                                    {{ $dataVal[$item['relation']['attribute']] }}
                                                @endif
                                            @elseif ($item['type'] === 'color')
                                                <i class="nav-icon fas fa-circle"
                                                    style="color: {{ $object->{$item['name']} }}"></i>
                                            @elseif ($item['type'] === 'option:relationship')
                                                @php
                                                    if (isset($item['empty'])) {
                                                        $relatedModels = $object->{$item['empty']}()->first();
                                                    } else {
                                                        $relatedModels = $object->{$item['relationship']}()->first();
                                                    }
                                                @endphp
                                                {{ $relatedModels->{$item['attribute']} ?? 'No Data' }}
                                            @elseif ($item['type'] === 'checkbox')
                                                @if ($object->{$item['name']} === 1)
                                                    <span class="badge text-success"><i
                                                            class="fas fa-check-circle nav-link fa-2x"></i></span>
                                                @else
                                                    <span class="badge text-secondary"><i
                                                            class="fas fa-circle nav-link fa-2x"></i></span>
                                                @endif
                                            @elseif ($item['type'] === 'action')
                                                @foreach ($item['action_link'] as $k => $i)
                                                    @if ($k === 'view')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-info btn-sm"><i
                                                                class="fas fa-eye"></i> {{ __("messages.view") }}</a>
                                                    @elseif ($k === 'edit')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-warning btn-sm"><i
                                                                class="fas fa-edit"></i> {{ __("messages.edit") }}</a>
                                                    @elseif ($k === 'delete')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fas fa-trash"></i> {{ __("messages.delete") }}</a>
                                                    @elseif ($k === 'restore')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-success btn-sm"><i
                                                                class="fas fa-undo"></i> {{ __("messages.restore") }}</a>
                                                    @elseif ($k === 'start')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-success btn-sm"><i
                                                                class="fas fa-play"></i> {{ __("messages.start") }}</a>
                                                    @elseif ($k === 'stop')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fas fa-stop"></i> {{ __("messages.stop") }}</a>
                                                    @elseif ($k === 'take')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-info btn-sm"><i
                                                                class="fas fa-check"></i> {{ __("messages.take") }}</a>
                                                    @elseif ($k === 'replacement')
                                                        <a href="{{ route($i, $object->id) }}"
                                                            class="btn btn-outline-warning btn-sm"><i
                                                                class="fas fa-exchange-alt"></i> {{ __("messages.replacement") }}</a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($dataTable) }}" class="text-center"
                                    style="vertical-align: middle!important;">
                                    No records found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="col-12">
                    @if ($objects)
                        {{ $objects->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
