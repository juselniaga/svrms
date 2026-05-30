<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Balas - {{ $application->reference_no }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12pt;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20mm;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-title {
            font-size: 16pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
        }

        .header-subtitle {
            font-size: 11pt;
            color: #666;
        }

        .reference-block {
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .reference-block div {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .date-place {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .recipient {
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .recipient-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .salutation {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .body-content {
            margin-bottom: 30px;
            text-align: justify;
            line-height: 1.8;
        }

        .signature-block {
            margin-top: 50px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 40px;
            padding-top: 5px;
            font-weight: bold;
        }

        .closing {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
            margin-bottom: 15px;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }

        .ref-cell {
            width: 150px;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
   

    <div class="reference-block">
        <table>
            <tr>
                <td class="ref-cell">Ruj. Kami</td>
                <td>: {{ $ruj_kami }}</td>
            </tr>
            <tr>
                <td class="ref-cell">No. Rujukan Permohonan</td>
                <td>: {{ $application->reference_no }}</td>
            </tr>
            <tr>
                <td class="ref-cell">Tajuk Projek</td>
                <td>: {{ $application->tajuk }}</td>
            </tr>
            <tr>
                <td class="ref-cell">Lokasi</td>
                <td>: {{ $application->lokasi }}</td>
            </tr>
            <tr>
                <td class="ref-cell">Pemaju</td>
                <td>: {{ $application->developer->name }}</td>
            </tr>
        </table>
    </div>

    <div class="date-place">
        <div>
            Kuala Lumpur,<br>
            {{ now()->locale('ms')->isoFormat('D MMMM YYYY') }}
        </div>
    </div>

    <div class="recipient">
        <div class="recipient-title">
            @if($addressed_to === 'YDP')
                Yang Berhormat Datuk Ketua Pengarah
            @elseif($addressed_to === 'SU')
                Tuan/Puan Setiausaha Utama
            @else
                Tuan/Puan Pengarah
            @endif
        </div>
        <div style="margin-top: 10px; color: #666;">
            Jabatan Perancangan Bandar dan Desa<br>
            Kementerian Perumahan dan Kerajaan Tempatan<br>
            Kuala Lumpur
        </div>
    </div>

    <div class="salutation">
        Assalamualaikum Wa Rahmatullahi Wa Barakatuh,
    </div>

    <div class="body-content">
        <p><strong>PERMOHONAN UNTUK PEMBANGUNAN: {{ $application->tajuk }}</strong></p>

        <p>Kami merujuk kepada permohonan pembangunan bertajuk "{{ $application->tajuk }}" di lokasi {{ $application->lokasi }} yang dibuat oleh {{ $application->developer->name }}.</p>

        <p>Dengan hormatnya, kami ingin memaklumkan bahawa permohonan tersebut telah melalui semua fasa pemeriksaan dan penilaian yang dikehendaki, termasuk:</p>

        <ol style="line-height: 1.8;">
            <li>Siasatan Tapak dan Verifikasi Maklumat</li>
            <li>Semakan oleh Pegawai Penilaian</li>
            <li>Verifikasi oleh Pemandu Peperiksaan</li>
            <li>Keputusan Akhir oleh Pengarah</li>
        </ol>

        <p>Laporan dossier yang lengkap dan menyeluruh telah disediakan dan disimpan dalam sistem SVRMS untuk rujukan. Semua dokumen pendukung, pelan, dan bukti telah dicatat dengan sempurna.</p>

        <p>Adalah di harap pihak tuan/puan dapat melakukan tindakan sewajarnya ke atas permohonan ini mengikut keputusan yang telah diambil.</p>

        <p>Sekiranya ada sebarang pertanyaan atau memerlukan maklumat lanjut, sila hubungi bahagian kami pada waktu pejabat yang ditetapkan.</p>

        <p>Terima kasih atas perhatian tuan/puan.</p>
    </div>

    <div class="closing">
        Sekian, Wassalamualaikum Wa Rahmatullahi Wa Barakatuh.
    </div>

    <div class="signature-block">
        <div class="closing">Yours faithfully,</div>
        <div style="margin-top: 50px;">
            <div class="signature-line"></div>
            <div style="margin-top: 5px; font-size: 11pt;">
                <p style="margin: 2px 0;">
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <span style="color: #666;">{{ Auth::user()->email ?? 'SVRMS Clerk' }}</span>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
