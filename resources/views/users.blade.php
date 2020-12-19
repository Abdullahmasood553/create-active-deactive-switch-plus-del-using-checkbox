@extends('layouts.master')
@section('content')
       <div class="container">
           <div id="message"></div>
        <form method="POST">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
                <th scope="col">Check All <input type="checkbox" class="selectall"></th>
                <th>
                     @csrf
                     @method('DELETE')
                    <button formaction="/deleteall" type="submit" class="btn btn-danger btn-sm">Delete All</button>
              
                 
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $key)
              <tr>
                <th scope="row">{{ $key->id }}</th>
                <td>{{ $key->name }}</td>
                <td>{{ $key->email }}</td>
                <td>
                    <input type="checkbox" class="toggle-class" data-id="{{ $key->id }}" data-toggle="toggle" data-style="slow" data-on="Enabled" data-off="Disabled" {{ $key->status == true ? 'checked' : ''}}>
                </td>
                <td> <input type="checkbox" class="selectbox" name="ids[]" value="{{ $key->id }}"></td>
                <td>
                   
                    <button formaction="{{ action('UserController@deleteall', $key->id) }}" class="btn btn-primary">Delete</button>
                </td>
                {{-- <td><input type="checkbox" class="toggle-class" data-id="{{ $key->id }}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" {{ $key->status == true ? 'checked' : ''}}></td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </form>
          {{ $users->links() }}
       </div>
@endsection



@push('scripts')

<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
    })
  </script>

  <script>
      $('.toggle-class').on('change', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
            $.ajax({
                type:'GET',
                dataType:'json',
                url: '{{ route('changeStatus') }}',
                data: {
                    'status': status,
                    'user_id':user_id},
                     success:function(data) {
                    console.log(data);
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Status Updated Successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            });
        });
  </script>

  <script>
      $('.selectall').click(function() {
            $('.selectbox').prop('checked', $(this).prop('checked'));
      });


      $('.selectbox').change(function() {
        var total = $('.selectbox').length;
        console.log(total);
        var number = $('.selectbox:checked').length;
        console.log(number);
        if(total == number) {
            $('.selectall').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
        }
      });

  </script>
@endpush