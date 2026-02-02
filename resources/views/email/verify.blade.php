<html lang="{{app()->getLocale()}}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
      body {
        margin: 0;
        padding: 0;
        background: #f6f6f6;
      }
      a { color: #365cce; text-decoration: none; }
      .container {
        max-width: 42rem;
        margin: 1.25rem auto;
        background: #fff;
        border-radius: 8px;
        font-family: Nunito, sans-serif;
        box-shadow: 0 2px 8px #e0e0e0;
        padding: 0;
      }
      .header {
        height: 200px;
        background-color: #365cce;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1.25rem;
        border-radius: 8px 8px 0 0;
      }
      .header-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
      .main-content {
        margin-top: 2rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
      }
      .border {
        border-style: solid;
        border-width: 1px;
        border-color: #365cce;
        border-radius: 0.25rem;
      }
      .otpbox {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
        font-weight: bold;
        color: #365cce;
        background: #f3f6fd;
      }
      .otp-row {
        display: flex;
        align-items: center;
        margin-top: 1rem;
        gap: 16px;
        justify-content: center;
      }
      .footertext { font-size : 12px; }
      .footer {
        background-color: #365cce;
        padding: 10px 0;
        color: #fff;
        text-align: center;
        border-radius: 0 0 8px 8px;
        margin-top: 2rem;
      }
      @media (max-width: 600px) {
        .container {
          max-width: 100%;
          margin: 0;
          border-radius: 0;
          box-shadow: none;
        }
        .header {
          height: 120px;
          padding: 1rem 0.5rem;
          border-radius: 0;
        }
        .main-content {
          margin-top: 1rem;
          padding-left: 0.75rem;
          padding-right: 0.75rem;
        }
        .otpbox {
          width: 2rem;
          height: 2rem;
          font-size: 1rem;
        }
        .otp-row {
          gap: 8px;
        }
        .footer {
          border-radius: 0;
        }
      }
    </style>
  </head>
<body>
  <div class="container">
    <div class="header">
      <div class="header-row">
        <div style="width: 2.5rem; height: 1px; background-color: #fff;"></div>
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
          <path fill="none" d="M0 0h24v24H0V0z"></path>
          <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"></path>
        </svg>
        <div style="width: 2.5rem; height: 1px; background-color: #fff;"></div>
      </div>
      <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        <div style="font-size: 24px; font-weight: bold; text-transform: capitalize; text-align:center">
            {{__('auth.email_verification_title')}}
        </div>
      </div>
    </div>
    <main class="main-content">
      <h4 style="color: #374151;">{{__('auth.email_verification_greeting')}} {{ $full_name ?? 'Pengguna' }},</h4>
      <p style="line-height: 1.5; color: #4b5563;">
        {{__('auth.email_verification_content')}}
      </p>
      <div class="otp-row">
        @foreach(str_split($code ?? '0000') as $digit)
          <p class="border otpbox">{{ $digit }}</p>
        @endforeach
      </div>
      <p style="margin-top: 1rem; line-height: 1.75; color: #4b5563;">
        {{__('auth.email_verification_minute')}}
        <span style="font-weight: bold;">{{ $minutes ?? 2 }} {{app()->getLocale() === "en" ? "minute" : "menit"}}</span>
      </p>
      <p style="margin-top: 2rem; color: #4b5563;">
        {{__('auth.email_verification_footer')}},<br />
        {{__('auth.email_verification_footer_from')}}
      </p>
    </main>
    <div class="footer">
      <p class="footertext">© {{ date('Y') }} {{{__('auth.email_verification_footer_copyright')}}}</p>
    </div>
  </div>
</body>
</html>
