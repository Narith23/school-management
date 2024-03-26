<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <tbody>
                        @foreach ($dataType as $item)
                            <tr>
                                <td style="vertical-align: middle !important;" class="text-capitalize">{{ $item['label'] }}: </td>
                                <td style="vertical-align: middle !important;">
                                    @if ($item['type'] === 'input:text')
                                        <input type="text" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:date')
                                        <input type="date" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:datetime')
                                        <input type="datetime-local" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:time')
                                        <input type="time" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:number')
                                        <input type="number" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:email')
                                        <input type="email" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:password')
                                        <input type="password" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:color')
                                        <input type="color" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ old($item['name']) }}">
                                    @elseif ($item['type'] === 'input:textarea')
                                        <textarea class="form-control" id="summernote" name="{{ $item['name'] }}">{{ old($item['name']) }}</textarea>
                                    @elseif ($item['type'] === 'input:file:image')
                                        Image
                                    @elseif ($item['type'] === 'input:checkbox')
                                        <input class="form-check-input" type="checkbox" role="switch" id=""
                                            name="{{ $item['name'] }}">
                                    @elseif ($item['type'] === 'option:select')
                                        <select class="form-control select2bs4" style="width: 100%;"
                                            name="{{ $item['name'] }}">
                                            <option value="">-- Select {{ $item['label'] }} --</option>
                                            @if (!empty($item['options']))
                                                @foreach ($item['options'] as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old($item['name']) == $key ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @elseif ($item['type'] === 'option:select_multiple')
                                        <select class="form-control select2bs4" style="width: 100%;"
                                            name="{{ $item['name'] }}[]" multiple="multiple">
                                            <option value="">-- Select {{ $item['label'] }} --</option>
                                            @if (!empty($item['options']))
                                                @foreach ($item['options'] as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ in_array($key, old($item['name']) ?? []) ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @elseif ($item['type'] === 'hidden')
                                        <input type="hidden" class="form-control" name="{{ $item['name'] }}"
                                            value="{{ $item['value'] ?? '' }}">
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
        <a href="{{ $url_index == 'project.show' ? route($url_index, $project->id) : route($url_index) }}"
            class="btn btn-secondary">{{ __("messages.cancel") }}</a>
        <input type="submit" class="btn btn-success" value="{{ __('messages.save') }} {{ $title }}">
    </div>
</div>
