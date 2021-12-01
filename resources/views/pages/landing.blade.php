@extends('layouts.app')

@section('content')
    <div class="hero py-4 container px-4 flex align-items-center justify-content-between">
        <div class="text my-2">
            <h1>expetr provides vital business management tools to help you track growth</h1>
            <p class="text-muted my-4">
                Track and analyse your expenses,Manage events and assign tasks all on one dashboard.
            </p>

            <a href="{{ route('welcome') }}"><button
                    class="hero-cta shadow-lg text-md btn btn-primary py-3 shadow-md px-5">
                    Get started. Its free !
                </button> </a>
        </div>
        <div class="image my-2">
            <img src="{{ asset('images/hero image.png') }}" alt="expetr screenshots">
        </div>
    </div>
    <div class="spacer py-3"></div>
    <div class="container">
        <div class="after-hero py-5 flex">
            <div class="text">
                <h2>It's more than management.It's a way of building team spirit</h2>
                <div class="spacer py-3"></div>
                <p class="text-muted">Create groups and hold meetings through our realtime chat system anytime with any
                    member
                    and Track individual task completion rates. Keep an eye on a video call feature meant to arrive soon.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/chat feature photo.png') }}" alt="chat feature photo display">
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark dont-miss-out"
        style="background-image: url('{{ asset('images/dont miss out.png') }}')">
        <div class="container flex">
            <div class="text">
                <h2 class="my-3">Dont miss out on activities at your workplace</h2>
                <div class="spacer py-3">
                </div>
                <a href="{{ route('exOrga') }}">
                    <button class="btn btn-light text-md py-3">
                        Join your team
                    </button>
                </a>
            </div>
        </div>
    </div>
    <h2 class="text-center tools-header my-5">
        expetr management Tools
    </h2>
    <div class="container flex wrap-reverse">
        <div class="image">
            <img src="{{ asset('images/recording.png') }}" alt="expence recording">
        </div>
        <div class="text">
            <h3>Expense recording and processing</h3>
            <div class="spacer py-3"></div>
            <p class="text-muted">Your expenses are recorded and grouped into nine categories through
                a series of data processing operations. Both overall and category totals are calculated
                and stored as history for analysis. The records are available as a pdf copy to all members any time.
                PDF copys of each month’s records are stored for future reference</p>
        </div>
    </div>
    <div class="spacer py-3"></div>
    <div class="container flex">
        <div class="text">
            <h3>Expense analysis</h3>
            <div class="spacer py-3"></div>
            <p class="text-muted">
                Accurate graphical presentations of your expense growth in form of bar charts,
                doughnut charts and line graphs are provided on both monthly and annual records.
                These graphs are available for download in png format.
            </p>
        </div>
        <div class="image">
            <img src="{{ asset('images/analysis.png') }}" alt="expense analysis">
        </div>

    </div>
    <div class="spacer py-3"></div>
    <div class="container flex wrap-reverse">
        <div class="image">
            <img src="{{ asset('images/task.png') }}" alt="expence recording">
        </div>
        <div class="text">
            <h3>Task tracking and assignment</h3>
            <div class="spacer py-3"></div>
            <p class="text-muted">Keeping track of tasks and who it was assigned to can be
                a daunting task on its own. Expetr helps you keep track of tasks after assigning
                them to registered team members.
                The system also includes deadline notification to those with assignments.</p>
        </div>
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'content');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
@endsection
