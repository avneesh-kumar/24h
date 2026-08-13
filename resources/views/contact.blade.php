@extends('layouts.app')

@section('title', 'Contact Us | ' . config('app.name'))
@section('meta_description', 'Contact Ready 24h Security for professional security solutions. Get in touch for a free quote or more information.')
@section('meta_keywords', 'Security guard services Los Angeles, Security services Riverside County, Security guard services Orange County, Security services San Diego County, Security guard services Ventura County, Security services California, Security company California')

@section('content')
    <div class="contact-banner">
        <div class="contact-banner-title">Contact Us</div>
    </div>
    <div class="contact-main">
        <div class="contact-info-col">
            <div class="contact-info-box">
                <h2>Contact Information</h2>

                <p>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:info@r24hs.com">
                        info@r24hs.com
                    </a>
                </p>

                <p>
                    <i class="fas fa-phone"></i>
                    <a href="tel:8885818424">
                        (888) 581-8424
                    </a>
                </p>

                <p>
                   

                 <i class="fas fa-map-marker-alt"></i>
                    <a 
            href="https://maps.app.goo.gl/okL2XxfnXTuy6Lks6"
            target="_blank"
            rel="noopener noreferrer"
            class="hover:underline"
        >
            23241 Ventura Blvd., Suite 219 Woodland Hills CA 91364
        </a>
                </p>
            </div>
            <div class="contact-map-box">

               <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.724548542113!2d-118.6322503!3d34.1622257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c29f6708fe309b%3A0x15fcf097fb99a180!2sREADY%2024h%20Security%20Inc.!5e0!3m2!1sen!2sus!4v1747710000000"
    width="100%"
    height="400"
    style="border:0; border-radius:12px; box-shadow:0 2px 16px rgba(185,28,28,0.07); margin-top:18px;"
    allowfullscreen
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>


            </div>
        </div>
        <div class="contact-form-col">
            <h2 class="contact-form-title">Gets in Touch</h2>
            <p class="contact-desc">Have a question or need a quote? Fill out the form below and our team will get back to
                you promptly.</p>
            <form method="POST" action="{{ route('contact.send') }}" class="contact-form">
                @csrf
                @if(session('status'))
                    <div style="background:#ecfdf5;border:1px solid #d1fae5;color:#065f46;padding:12px;border-radius:8px;margin-bottom:12px;">{{ session('status') }}</div>
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="contact-btn">Send Message</button>
            </form>
        </div>
    </div>
    <style>
        .contact-banner {
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            max-width: 100vw;
            background: linear-gradient(90deg, #b91c1c 60%, #fff 100%);
            color: #fff;
            padding: 60px 0 40px 0;
            text-align: center;
            position: relative;
        }

        .contact-banner-title {
            font-size: 2.6rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: #fff;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.13);
        }

        .contact-main {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            width: 90vw;
            max-width: 1200px;
            margin: 0 auto 60px auto;
            padding: 40px 0 0 0;
            align-items: flex-start;
        }

        .contact-form-col {
            flex: 1 1 420px;
            min-width: 320px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(185, 28, 28, 0.07);
            padding: 40px 32px;
            border: 1px solid #f3f4f6;
        }

        .contact-form-title {
            font-size: 1.5rem;
            color: #b91c1c;
            font-weight: 700;
            margin-bottom: 18px;
            text-align: left;
        }

        .contact-desc {
            color: #444;
            font-size: 1.08rem;
            margin-bottom: 28px;
            text-align: left;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-group label {
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 1rem;
            color: #23272b;
            background: #fff;
            transition: border 0.2s, box-shadow 0.2s;

        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #b91c1c;
            outline: none;
            box-shadow: 0 0 0 2px #fee2e2;
        }

        .contact-btn {
            background: #b91c1c;
            color: #fff;
            font-weight: 700;
            font-size: 1.08rem;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(185, 28, 28, 0.07);
        }

        .contact-btn:hover {
            background: #991b1b;
            box-shadow: 0 4px 16px rgba(185, 28, 28, 0.13);
        }

        .contact-info-col {
            flex: 1 1 320px;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .contact-info-box {
            background: #fff5f5;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(185, 28, 28, 0.07);
            padding: 40px 32px;
            border: 1px solid #f3f4f6;
            width: 100%;
            color: #444;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .contact-map-box {
            width: 100%;
            margin-top: 12px;
        }

        .contact-info-box h2 {
            font-size: 1.15rem;
            color: #b91c1c;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .contact-info-box a {
            color: #b91c1c;
        }

        .contact-info-box p {
            margin-bottom: 14px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contact-info-box i {
            color: #b91c1c;
            font-size: 1.1em;
        }

        @media (max-width: 900px) {
            .contact-main {
                flex-direction: column;
                gap: 24px;
                width: 98vw;
                padding: 20px 0 0 0;
            }

            .contact-form-col,
            .contact-info-col {
                padding: 24px 8px;
            }

            .contact-info-box {
                padding: 24px 8px;
            }
        }
    </style>
@endsection