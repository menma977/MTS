@extends('layouts.android')

@section('content')
    <div class="table-responsive">
        <ul class="tree">
            <li>
                <div class="fa fa-minus-circle" style="min-width: 200px" id="showBug">
                    {{ Auth::user()->username }}
                </div>
                <ul class="nested">
                    @foreach ($binary as $item)
                        <li>
                            <a href="#" id="caret-{{ $item->user }}" class="fa fa-plus-circle"
                               onclick="addCaret('{{ $item->user }}')" style="min-width: 200px">
                                @if ($item->userDownLine)
                                    {{ $item->userDownLine->name }}
                                @endif
                            </a>
                            <div id="{{ $item->user }}"></div>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
@endsection

@section('endCSS')
    <style>
        ul.tree,
        ul.tree ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.tree ul {
            margin-left: 10px;
        }

        ul.tree li {
            margin: 0;
            padding: 0 10px;
            line-height: 20px;
            font-weight: bold;
        }

        ul.tree li:last-child {
            border-left: none;
        }

        ul.tree li:before {
            position: relative;
            top: -0.3em;
            height: 1em;
            width: 12px;
            color: white;
            content: "";
            display: inline-block;
            left: -7px;
        }
    </style>
@endsection

@section('endJS')
    <script>
      function addCaret(user) {
        if (document.getElementById('caret-' + user).className === "fa fa-minus-circle") {
          document.getElementById(user).innerHTML = "";
          document.getElementById('caret-' + user).className = "fa fa-plus-circle";
        } else {
          document.getElementById('caret-' + user).className = "fa fa-minus-circle";
          let url = "{{ url("/api/binary/show/%data%") }}";
          url = url.replace('%data%', user);
          let data = '';
          fetch(url, {
            method: 'GET',
            headers: new Headers({
              'X-Requested-With': 'XMLHttpRequest',
            }),
          }).then((response) => response.json()).then((responseData) => {
            let idSponsor = 0;
            let htmlBody = '';
            data = responseData;
            responseData.forEach(element => {
              idSponsor = element.sponsor;
              let user = '<li>' +
                '<a href="#" id="caret-'
                + element.user
                + '" class="fa fa-plus-circle" onclick="addCaret(`%data%`)" style="min-width: 200px"> '
                + element.userDownLine.name
                + '</a> <div id="'
                + element.user + '"></div>'
                + '</li>';
              user = user.replace('%data%', element.user);
              htmlBody += '<ul class="nested active">' + user + '</ul>';
            });
            document.getElementById(idSponsor).innerHTML = htmlBody;
          }).catch((error) => {
            //console.log(error);
          });
        }
      }
    </script>
@endsection