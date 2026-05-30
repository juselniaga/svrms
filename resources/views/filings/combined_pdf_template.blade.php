<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SVRMS Dossier & Surat Balas: {{ $application->reference_no }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #333;
            line-height: 1.05;
            margin: 0;
            padding: 24mm 10mm 10mm 10mm;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #5a189a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #5a189a;
            margin: 0;
            font-size: 20pt;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 10pt;
            color: #666;
        }

        .section-title {
            background-color: #f3e8ff;
            color: #5a189a;
            padding: 8px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
            border-left: 4px solid #5a189a;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            width: 30%;
            background-color: #fafafa;
            font-weight: bold;
            color: #555;
        }

        .page-break {
            page-break-after: always;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .prose {
            border: 1px solid #eee;
            padding: 15px;
            background-color: #fafafa;
        }

        .findings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .finding-card {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 12px;
            background-color: #fff;
            page-break-inside: avoid;
        }

        .finding-card-header {
            background-color: #5a189a;
            color: white;
            padding: 8px;
            margin: -12px -12px 10px -12px;
            border-radius: 4px 4px 0 0;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .finding-text {
            font-size: 10pt;
            line-height: 1.3;
            margin-bottom: 10px;
            color: #374151;
            min-height: 40px;
        }

        .photos-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 10px;
        }

        .photo-thumb {
            max-width: 100%;
            max-height: 120px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            display: block;
        }





        /********* Surat Balas Styles *********/
          .reference-block {
            float: right;
            text-align: left;
            margin-bottom: 20px;
            line-height: 1.05;
        }
 
        .reference-block table {
            width: auto;
            border-collapse: collapse;
        }
 
        .reference-block td {
            padding: 0 4px 0 0;
            vertical-align: top;
            white-space: nowrap;
        }
 
        .ref-label {
            font-weight: normal;
            color: #000;
            min-width: 80px;
        }
 
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
 
        /* ── Recipient block (left-aligned, below ref) ── */
        .recipient {
            margin-top: 10px;
            margin-bottom: 25px;
            line-height: 1.05;
            clear: both;
        }
 
        .recipient-name {
            font-weight: bold;
        }
 
        /* ── Salutation ── */
        .salutation {
            margin-bottom: 20px;
        }
 
        /* ── Subject line ── */
        .subject {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
            text-align: justify;
            line-height: 1.05;
        }
 
        /* ── Body paragraphs ── */
        .body-content {
            text-align: justify;
            line-height: 1.05;
        }
 
        .body-content p {
            margin: 0 0 12px 0;
        }
 
        /* Numbered main paragraphs */
        .numbered-para {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }
 
        .para-num {
            min-width: 20px;
            font-weight: normal;
        }
 
        .para-text {
            flex: 1;
            text-align: justify;
        }
 
        /* Sub-points (e.g. 2.1, 2.2 …) */
        .sub-points {
            margin: 8px 0 8px 32px;
            line-height: 1.05;
        }
 
        .sub-points table {
            width: 100%;
            border-collapse: collapse;
        }
 
        .sub-points td {
            padding: 2px 4px 2px 0;
            vertical-align: top;
        }
 
        .sub-num {
            min-width: 36px;
            white-space: nowrap;
        }
 
        /* ── Closing ── */
        .closing-line {
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: justify;
        }
 
        /* ── Motto block ── */
        .motto-block {
            margin: 20px 0;
            line-height: 1.0;
        }
 
        .motto-block p {
            margin: 2px 0;
        }
 
        /* ── Signature block ── */
        .signature-block {
            margin-top: 30px;
        }
 
        .signature-label {
            margin-bottom: 50px; /* space for actual signature */
        }
 
        .signature-name {
            font-weight: bold;
            text-transform: uppercase;
            border-top: 2px solid #000;
            display: inline-block;
            padding-top: 4px;
            min-width: 260px;
        }
 
        .signature-title {
            font-weight: normal;
            margin: 4px 0 2px 0;
        }
 
        .signature-org {
            font-weight: normal;
            margin: 0;
        }
 
        /* Print / PDF helpers */
        @media print {
            body { padding: 15mm 20mm; }
        }
    </style>
</head>

<body>
    <!-- PART 1: LAPORAN (REPORT) -->
    <div class="header">
        <h1>Site Visit Report Management System (SVRMS)</h1>
        <p>Official Application Dossier</p>
        <p>Generated: {{ now()->format('d M Y, H:i') }}</p>
    </div>

    <!-- 1. Executive Summary -->
    <div class="section-title">1. Executive Summary & Final Decision</div>
    @php $approval = $application->approvals->last(); @endphp
    <table class="data-table">
        <tr>
            <th>Application Ref No.</th>
            <td><strong>{{ $application->reference_no }}</strong></td>
        </tr>
        <tr>
            <th>Final Status</th>
            <td>
                @if($application->status === 'FILED' && $approval)
                    @if($approval->decision === 'APPROVED')
                        <span class="badge badge-success">APPROVED & FILED</span>
                    @else
                        <span class="badge badge-danger">REJECTED & FILED</span>
                    @endif
                @else
                    <strong>{{ $application->status }}</strong>
                @endif
            </td>
        </tr>
        <tr>
            <th>Final Decision By</th>
            <td>{{ $approval ? $approval->director->name : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Decision Date</th>
            <td>{{ $approval ? $approval->created_at->format('d M Y, H:i') : 'N/A' }}</td>
        </tr>
    </table>

    <!-- 2. Application Details -->
    <div class="section-title">2. Application, Location & Developer Details</div>
    <table class="data-table">
        <tr>
            <th>Project Title</th>
            <td>{{ $application->tajuk }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $application->lokasi }}</td>
        </tr>
        @if($application->site)
            <tr>
                <th>Land Information</th>
                <td>Mukim: {{ $application->site->mukim }} | Lot: {{ $application->site->lot }} | Area: {{ number_format($application->site->luas, 4) }}</td>
            </tr>
        @endif
        <tr>
            <th>Developer</th>
            <td>{{ $application->developer->name }}</td>
        </tr>
    </table>

    <div class="page-break"></div>

    <!-- 3. Site Visit Report -->
    <div class="header">
        <h1>Phase 1: Site Investigation</h1>
    </div>

    @php $siteVisit = $application->siteVisits->last(); @endphp
    @if($siteVisit)
        <table class="data-table">
            <tr>
                <th>Inspecting Officer</th>
                <td>{{ $siteVisit->officer->name }}</td>
            </tr>
            <tr>
                <th>Visit Date</th>
                <td>{{ $siteVisit->visit_date->format('d M Y') }}</td>
            </tr>
            @if($siteVisit->location_data)
                <tr>
                    <th>GPS Capture</th>
                    <td>{{ $siteVisit->location_data }}</td>
                </tr>
            @endif
        </table>

        <h4 style="color:#5a189a; margin-top:20px;">Directional Boundary Synthesis & Site Documentation</h4>
        <div class="findings-grid">
            <!-- North -->
            <div class="finding-card">
                <div class="finding-card-header">North</div>
                <div class="finding-text">{{ $siteVisit->finding_north ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_north && is_array($siteVisit->photos_north) && count($siteVisit->photos_north) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_north as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- South -->
            <div class="finding-card">
                <div class="finding-card-header">South</div>
                <div class="finding-text">{{ $siteVisit->findings_south ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_south && is_array($siteVisit->photos_south) && count($siteVisit->photos_south) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_south as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- East -->
            <div class="finding-card">
                <div class="finding-card-header">East</div>
                <div class="finding-text">{{ $siteVisit->findings_east ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photo_east && is_array($siteVisit->photo_east) && count($siteVisit->photo_east) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photo_east as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- West -->
            <div class="finding-card">
                <div class="finding-card-header">West</div>
                <div class="finding-text">{{ $siteVisit->finding_west ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photo_west && is_array($siteVisit->photo_west) && count($siteVisit->photo_west) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photo_west as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Jalan -->
            <div class="finding-card">
                <div class="finding-card-header">Jalan (Road)</div>
                <div class="finding-text">{{ $siteVisit->finding_jalan ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_jalan && is_array($siteVisit->photos_jalan) && count($siteVisit->photos_jalan) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_jalan as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Location -->
            <div class="finding-card">
                <div class="finding-card-header">Lokasi (Location)</div>
                <div class="finding-text">{{ $siteVisit->finding_location ?: 'No observations recorded.' }}</div>
                @if($siteVisit->photos_location && is_array($siteVisit->photos_location) && count($siteVisit->photos_location) > 0)
                    <div class="photos-container">
                        @foreach($siteVisit->photos_location as $photo)
                            @php
                                $path = storage_path('app/public/' . $photo);
                                $base64 = file_exists($path) ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path)) : null;
                            @endphp
                            @if($base64)
                                <img src="{{ $base64 }}" class="photo-thumb">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="page-break"></div>

    <!-- PART 2: SURAT BALAS (RESPONSE LETTER) -->
   <div class="reference-block">
        <table>
            <tr>
                <td class="ref-label">Ruj. Kami</td>
                <td>: MPJ/JPB/1100-6Klt 1BHG.24.sk(36)</td>
            </tr>
            <tr>
                <td class="ref-label">Ruj. Tuan</td>
                <td>: PDTJ.600-2/6/133(9)</td>
            </tr>
            <tr>
                <td class="ref-label">Tarikh</td>
                <td>:   Mei 2026</td>
            </tr>
        </table>
    </div>
 
 
    <div class="recipient">
       
      <div><strong>YBhg. Datuk Rahizi Bin Ranom</strong></div>
      <div>Pegawai Daerah</div>
      <div>Pejabat Daerah dan Tanah Jasin</div>
	  <div>77000 Jasin</div>
	  <div>Melaka</div>
	  
    </div>
 
    
    <div class="salutation">YBhg. Datuk / Tuan / Puan,</div>
 
 
    <div class="subject">
        PERMOHONAN UNTUK MEMILIKI TANAH KERAJAAN SECARA LESEN PENDUDUKAN SEMENTARA(LPS) DI ATAS LOT 7 SELUAS 297.7477 HEKTAR MUKIM KESANG, DAERAH JASIN, MELAKA UNTUK TUJUAN MENGELUARKAN HASIL PERTANIAN KELAPA SAWIT DI BAWAH SEKSYEN 65 KANUN TANAH NEGARA(AKTA 828)
    </div>
    <div class="subject">
	Nama Pemohon : Synergy Argo Farm Sdn.Bhd
	Alamat 	 : No 4.Jalan TE 1 taman Tiong Emas 75450 Bukit Katil Melaka.
    </div>
 
 
    <div class="body-content">
 
       
        <p>
            Dengan segala hormatnya saya merujuk kepada perkara di atas dan surat daripada
            pihak YBhg.Datuk/tuan/puan bertarikh 24 April 2026  adalah berkaitan.
        </p>
 
       
        <div class="numbered-para">
            <span class="para-num">2.</span>
            <span class="para-text">
                Dimaklumkan bahawa pihak Majlis <strong>tiada halangan</strong> terhadap permohonan
                tersebut berdasarkan:-
 
                <div class="sub-points">
                    <table>
                        <tr>
                            <td class="sub-num">2.1</td>
                            <td>Tapak terletak di zon guna tanah pertanian: BPK 3.4: Seri Kesang berdasarkan Rancangan Tempatan Majlis Perbandaran Jasin 2035;</td>
				   
                        </tr>
                        <tr>
                            <td class="sub-num">2.2</td>
                            <td>Aktiviti yang dipohon merupakan aktiviti yang dibenarkan;</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.3</td>
                            <td>Pada pandangan MPJ, dari segi saiz dan kedudukan tanah sesuai dimohon oleh agensi kerajaan;</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.4</td>
                            <td>Sebarang binaan dan kerja tanah perlu kelulusan MPJ
                                terlebih dahulu;</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.5</td>
                            <td>Mematuhi ulasan dan syarat teknikal jabatan lain.</td>
                        </tr>
                    </table>
                </div>
            </span>
        </div>
 
    </div>
 

    <div class="closing-line">
        Sekian dimaklumkan untuk tindakan pihak YBhg. Datuk / Tuan / Puan selanjutnya. Terima kasih.
    </div>
 
   
    <div class="motto-block">
        <p>"<strong>MELAKAKU MAJU JAYA, RAKYAT BAHAGIA MENGAMIT DUNIA</strong>"</p>
        <p>"<strong>BIJAK LANSANA TUAN,BERANI LAKSANA JEBAT</strong>"</p>
        <p>"<strong>MELAKA SAYANG RAKYAT</strong>"</p>
	  <p>"<strong>MALAYSIA MADANI</strong>"</p>
	  <p>"<strong>BERHIDMAT UNTUK NEGARA</strong>"</p>
	  <p>"<strong>MPJ PERIHATIN DI HATIKU</strong>"</p>
	    
       
    </div>
 
   
    <div class="signature-block">
        <p class="signature-label">Saya yang menjalankan amanah,</p>
 
        <div>
            <span class="signature-name">MUHAMMAD ZAHIRUDDIN BIN MOHD ZAHARI</span>
            <p class="signature-title">Yang Dipertua,</p>
            <p class="signature-org">Majlis Perbandaran Jasin,</p>
            <p class="signature-org">Melaka.</p>
        </div>
    </div> 

</body>
</html>
