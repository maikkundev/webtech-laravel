@extends('layouts.app')

@section('title', 'Αρχική')

@section('content')
    <div class="min-vh-100">
        <!-- Hero Section -->
        <div class="text-white py-5" style="background: linear-gradient(135deg, #F53003 0%, #d42a00 100%);">
            <div class="container-xxl text-center py-5">
                <h1 class="display-4 fw-bold mb-4">
                    Καλώς ήρθατε στο {{ config('app.name', 'WebTech Laravel') }}
                </h1>
                <p class="lead mb-4">
                    Διαχειριστείτε τις λίστες βίντεο και το περιεχόμενό σας με ευκολία
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('playlists.index') }}" class="btn btn-light fw-semibold px-4 py-2"
                        style="color: #F53003 !important;">
                        Περιήγηση Λιστών
                    </a>
                    <a href="{{ route('videos.index') }}" class="btn btn-outline-light fw-semibold px-4 py-2">
                        Προβολή Βίντεο
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-5 bg-body-secondary">
            <div class="container-xxl">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">
                        Χαρακτηριστικά
                    </h2>
                    <p class="lead text-body-secondary">
                        Όλα όσα χρειάζεστε για τη διαχείριση του περιεχομένου σας
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center p-4 h-100 border rounded bg-body">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 64px; height: 64px; background-color: #F53003;">
                                <svg width="32" height="32" fill="white" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12 5.5z"></path>
                                </svg>
                            </div>
                            <h3 class="h5 fw-semibold mb-2">Διαχείριση Βίντεο</h3>
                            <p class="text-body-secondary">Οργανώστε και διαχειριστείτε τη συλλογή βίντεο σας</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center p-4 h-100 border rounded bg-body">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 64px; height: 64px; background-color: #F53003;">
                                <svg width="32" height="32" fill="white" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="h5 fw-semibold mb-2">Δημιουργία Λιστών</h3>
                            <p class="text-body-secondary">Δημιουργήστε προσαρμοσμένες λίστες για το περιεχόμενό σας</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center p-4 h-100 border rounded bg-body">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 64px; height: 64px; background-color: #F53003;">
                                <svg width="32" height="32" fill="white" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="h5 fw-semibold mb-2">Ταχύτητα</h3>
                            <p class="text-body-secondary">Κατασκευασμένο με Laravel για βέλτιστη απόδοση</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
