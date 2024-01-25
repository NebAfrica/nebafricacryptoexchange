@foreach ($view_data['sections']->where('name', 'deposit_withdraw') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div  >
            <h5>Deposits</h5>
            <table>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                @foreach ($view_data['deposits'] as $deposit)
                    <tr>
                        <td>{{ adminUser($deposit->user_id, 'first_name') }}</td>
                        <td>{{ formatAmount($deposit->amount) }}</td>
                        <td>{{ formatPastDate(strtotime($deposit->created_at)) }}</td>
                    </tr>
                @endforeach
            </table>
            
            
        </div>

        <div  >
            <h5>Withdrawals</h5>
            <table>
                <tr>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                @foreach ($view_data['withdrawals'] as $withdrawal)
                    <tr>
                        <td>{{ adminUser($withdrawal->user_id, 'first_name') }}</td>
                        <td>{{ formatAmount($withdrawal->amount) }}</td>
                        <td>{{ formatPastDate(strtotime($withdrawal->created_at)) }}</td>
                    </tr>
                @endforeach
            </table>
            
            
        </div>
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach


