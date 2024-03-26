<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <tbody>
                        @foreach ($dataType as $item)
                            <tr>
                                <td style="vertical-align: middle !important;">{{ $item['label'] }}: </td>
                                <td style="vertical-align: middle !important;">
                                    @if ($item['type'] === 'input:text')
                                        <input type="text" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:date')
                                        <div class="row">
                                            <div class="col-6">
                                                @php
                                                    $dataFormat = new DateTime($object[$item['name']]);
                                                    $dataFormat = $dataFormat->format('d M Y');
                                                @endphp
                                                {{ $dataFormat }}
                                            </div>
                                            <div class="col-6">
                                                <input type="date" class="form-control" name="{{ $item['name'] }}"
                                                    value="{{ $object[$item['name']] }}">
                                            </div>
                                        </div>
                                    @elseif ($item['type'] === 'input:datetime')
                                        <div class="row text-center">
                                            <div class="col-6">
                                                @php
                                                    $dataFormat = new DateTime($object[$item['name']]);
                                                    $dataFormat = $dataFormat->format('d M Y h:i:s A');
                                                @endphp
                                                {{ $dataFormat }}
                                            </div>
                                            <div class="col-6">
                                                <input type="datetime-local" class="form-control"
                                                    name="{{ $item['name'] }}" value="{{ $object[$item['name']] }}">
                                            </div>
                                        </div>
                                    @elseif ($item['type'] === 'input:time')
                                        <input type="time" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:number')
                                        <input type="number" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:email')
                                        <input type="email" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:password')
                                        <input type="password" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:color')
                                        <input type="color" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'input:textarea')
                                        <textarea class="form-control" id="summernote" name="{{ $item['name'] }}">{{ $object[$item['name']] }}</textarea>
                                    @elseif ($item['type'] === 'input:file:image')
                                        Image
                                    @elseif ($item['type'] === 'input:checkbox')
                                        <input type="checkbox" name="{{ $item['name'] }}"
                                            @if ($object[$item['name']] === 1) checked @endif>
                                    @elseif ($item['type'] === 'hidden')
                                        <input type="hidden" name="{{ $item['name'] }}"
                                            value="{{ $object[$item['name']] }}">
                                    @elseif ($item['type'] === 'option:select')
                                        <select class="form-control select2bs4" style="width: 100%;"
                                            name="{{ $item['name'] }}">
                                            <option value="">-- Select {{ $item['label'] }} --</option>
                                            @if (!empty($item['options']))
                                                @foreach ($item['options'] as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $object[$item['name']] == $key ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <a href="{{ route($url_index) }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" class="btn btn-success" value="Update {{ $title }}">
    </div>
</div>
