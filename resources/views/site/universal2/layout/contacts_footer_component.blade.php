
    @foreach($site->localOffices as $localOffice)
        @foreach($localOffice->localOfficePhones as $phone)
            @if($phone->show_at_footer)
                <br>
                    <a class="footer__email footer-email"
                       style="background:none; padding-left:1em;"
                       href="tel:{{ $phone->phone_value }}">{{ $phone->phone_text }}</a>
            @endif
        @endforeach

        @foreach($localOffice->localOfficeEmails as $email)
            @if($email->show_at_footer)
                <br>
                <a class="footer__email footer-email" href="mailto:{!! $email->email !!}">{!! $email->email !!}</a>
            @endif
        @endforeach
    @endforeach
