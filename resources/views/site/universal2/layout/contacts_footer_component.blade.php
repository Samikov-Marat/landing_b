<div class="">
    @foreach($site->localOffices as $localOffice)
        @foreach($localOffice->localOfficePhones as $phone)
            @if($phone->show_at_footer)
                <div class="footer__phone-item">
                    <a class="footer__phone" href="tel:{{ $phone->phone_value }}">{{ $phone->phone_text }}</a>
                </div>
            @endif
        @endforeach

        @foreach($localOffice->localOfficeEmails as $email)
            @if($email->show_at_footer)
                <a class="footer__email footer-email" href="mailto:{!! $email->email !!}">{!! $email->email !!}</a>
            @endif
        @endforeach
    @endforeach
</div>