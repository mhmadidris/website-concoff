@extends('layouts.front')

@section('title', ' About')

@section('content')

    {{-- Navigation bar --}}
    @include('includes.Frontend.navbar')

    <section class="shayna-header position-relative overflow-hidden">
        <style>
          @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Noto+Sans:wght@400;700&display=swap");

          :root {
            --dark-1: #101d2e;
            --dark-2: #0f1c2d;
            --dark-3: #1e2a39;
            --grey-1: #6f7781;
            --grey-2: #626a7f;
            --dull-purple: #7f31ff;
            --strong-purple: #8f00ff;
            --soft-purple: #f9faff;
            --noto-sans: 'Noto Sans', sans-serif;
            --montserrat: 'Montserrat', sans-serif;
            ;
          }

          /* START:Header */
          .header-background img {
            z-index: -1;
            width: 100%;
            top: 120px;
            left: 0;
            right: 0;
          }

          .shayna-header main {
            font-family: var(--noto-sans);
            font-size: 16px;
            padding-top: 88px;
            padding-bottom: 64px;
          }

          .shayna-header .headline {
            font-family: var(--montserrat);
            font-size: 54px;
            font-weight: 500;
            line-height: 70px;
            text-align: center;
            color: var(--dark-3);
            width: auto;
          }

          .shayna-header .header-description>p {
            color: var(--grey-2);
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            font-weight: 400;
            margin: 16px 0 42px;
            width: auto;
          }

          .btn-join {
            padding: 20px 32px;
            color: #fff;
            font-weight: 400;
            font-size: 20px;
            background-color: var(--dull-purple);
            border-radius: 50px;
          }

          .btn-join:hover {
            color: var(--soft-purple);
            background-color: var(--strong-purple);
          }

          .statistic-text {
            text-align: center;
            color: var(--grey-2);
            font-size: 16px;
            font-weight: 600;
            margin-top: 200px;
            margin-bottom: 24px;
          }

          .partner-logo {
            font-family: var(--montserrat);
            font-weight: 600;
            font-size: 24px;
            letter-spacing: -2%;
            color: #a5aab0;
          }

          @media (max-width: 765px) {
            .shayna-header .headline {
              font-size: 40px;
              line-height: 48px;
            }
          }

          @media (min-width: 768px) {
            .header-background img {
              top: 375px;
            }
          }

          @media (min-width: 992px) {
            .header-background img {
              top: 250px;
            }

            .shayna-header .headline {
              width: 900px;
            }

            .shayna-header .header-description>p {
              width: 487px;
            }
          }

          @media (min-width: 1025px) {
            .header-background img {
              top: 175px;
            }
          }

          /* END:Header */
        </style>

        <!-- HEADER BACKGROUND -->
        <main class="container">
          <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="mt-4 mb-4">
              <style>
                .image-logo-about{
                  width: 350px;
                }
              </style>
              <img src="{{ asset('frontend/images/main-logo.png') }}" alt="logo" class="image-logo-about">
            </div>
            <div class="headline">
              Stay Stunning and Positive
            </div>
            <div class="mt-3 header-description">
              <p class="text-center">
                Bertjorak is an everyday fashion brand with bright and pop colors, while also portraying the essence of quirkiness. Inspired by the diversity of Indonesia’s colors of its cultures, we express a variety of philosophies through different splash of eccentric colors with the intention to spread positive energy and youthfulness across all fashion savvy and people in Indonesia.
              </p>
            </div>
            <div class="d-block">
              <a href="https://api.whatsapp.com/send?phone=6281222331598&text=Greetings gorg' human. 
You've reached Bertjorak chit-chat space. 

Have anything in mind? Just simply ask us any of your curiosity." class="btn btn-join"> Contact Us </a>

            </div>



          </div>
        </main>
      </section>

@endsection
