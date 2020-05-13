@extends ('admin/layouts/app')

@section ('content')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <style>

    #table-log {
        font-size: 0.85rem;
    }

    .sidebar {
        font-size: 0.85rem;
        line-height: 1;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }

    .list-group-item {
      word-wrap: break-word;
    }

    .folder {
      padding-top: 15px;
    }

    .div-scroll {
      height: 80vh;
      overflow: hidden auto;
    }
    .nowrap {
      white-space: nowrap;
    }

  </style>
<div class="container-fluid">
  <div class="row">
    <div class="col sidebar mb-3">

        <h5><i class="fa fa-calendar" aria-hidden="true"></i> {{__('System Log Viewer')}}</h5>
        <br>
        <div class="list-group div-scroll">
                    @foreach($folders as $folder)
                        <div class="list-group-item">
                            <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
                                <span class="fa fa-folder"></span> {{$folder}}
                            </a>
                            @if ($current_folder == $folder)
                                <div class="list-group folder">
                                    @foreach($folder_files as $file)
                                        <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                                           class="list-group-item @if ($current_file == $file) llv-active @endif">
                                            {{$file}}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                    @foreach($files as $file)
                        <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                           class="list-group-item @if ($current_file == $file) llv-active @endif">
                            {{$file}}
                        </a>
                    @endforeach
                </div>
    </div>
    <div class="col-10 table-container">
      <div class="panel">
          <div class="panel-body">
              @if ($logs === null)
                  <div>
                      {{__('Log file >50M, please download it.')}}
                  </div>
              @else
                  <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                      <thead>
                      <tr>
                          @if ($standardFormat)
                              <th>{{__('Level')}}</th>
                              <th>{{__('Context')}}</th>
                              <th>{{__('Date')}}</th>
                          @else
                              <th>{{__('Line number')}}</th>
                          @endif
                          <th>{{__('Content')}}</th>
                      </tr>
                      </thead>
                      <tbody>

                      @foreach($logs as $key => $log)
                          <tr data-display="stack{{{$key}}}">
                              @if ($standardFormat)
                                  <td class="nowrap text-{{{$log['level_class']}}}">
                                      <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                  </td>
                                  <td class="text">{{$log['context']}}</td>
                              @endif
                              <td class="date">{{{$log['date']}}}</td>
                              <td class="text">
                                  @if ($log['stack'])
                                      <button type="button"
                                              class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                              data-display="stack{{{$key}}}">
                                          <span class="fa fa-search"></span>
                                      </button>
                                  @endif
                                  {{{$log['text']}}}
                                  @if (isset($log['in_file']))
                                      <br/>{{{$log['in_file']}}}
                                  @endif
                                  @if ($log['stack'])
                                      <div class="stack" id="stack{{{$key}}}"
                                           style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                      </div>
                                  @endif
                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                  </table>
              @endif
              <div class="p-3">
                  @if($current_file)
                      <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                          <span class="fa fa-download"></span> Download file
                      </a>
                      -
                      <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                          <span class="fa fa-sync"></span> Clean file
                      </a>
                      -
                      <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                          <span class="fa fa-trash"></span> Delete file
                      </a>
                      @if(count($files) > 1)
                          -
                          <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                              <span class="fa fa-trash-alt"></span> Delete all files
                          </a>
                      @endif
                  @endif
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script.body')
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('#delete-log, #clean-log, #delete-all-log').click(function () {
                return confirm('Are you sure?');
            });
        });
    </script>
@endsection