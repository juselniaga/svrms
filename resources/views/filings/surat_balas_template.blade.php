<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Balas - {{ $application->reference_no }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.6;
            margin: 0;
            padding: 20mm 25mm;
        }

        /* ── Top-right reference block (matches PDF layout) ── */
        .reference-block {
            float: right;
            text-align: left;
            margin-bottom: 20px;
            line-height: 1.9;
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
            line-height: 1.8;
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
            line-height: 1.6;
        }

        /* ── Body paragraphs ── */
        .body-content {
            text-align: justify;
            line-height: 1.8;
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
            line-height: 1.8;
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
            line-height: 1.7;
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

    {{-- ── Reference block (floated right, per PDF layout) ── --}}
    <div class="reference-block">
        <table>
            <tr>
                <td class="ref-label">Ruj. Kami</td>
                <td>: {{ $ruj_kami }}</td>
            </tr>
            <tr>
                <td class="ref-label">Ruj. Tuan</td>
                <td>: {{ $application->reference_no }}</td>
            </tr>
            <tr>
                <td class="ref-label">Tarikh</td>
                <td>: {{ now()->locale('ms')->isoFormat('D MMMM YYYY') }}</td>
            </tr>
        </table>
    </div>

    {{-- ── Recipient (left, clears float) ── --}}
    <div class="recipient">
        <div class="recipient-name">
            @if($addressed_to === 'YDP')
                YBhg. Datuk Ketua Pengarah
            @elseif($addressed_to === 'SU')
                Tuan/Puan Setiausaha Utama
            @else
                Tuan/Puan Pengarah
            @endif
        </div>
        <div>{{ $jawatan ?? 'Pegawai Daerah,' }}</div>
        <div>{{ $jabatan ?? 'Pejabat Daerah dan Tanah' }},</div>
        <div>{{ $application->lokasi }}</div>
    </div>

    {{-- ── Salutation ── --}}
    <div class="salutation">YBhg. Datuk / Tuan / Puan,</div>

    {{-- ── Subject ── --}}
    <div class="subject">
        PERMOHONAN UNTUK {{ $application->tajuk | upper }}<br>
        {{ $application->lokasi | upper }}
    </div>

    {{-- ── Body ── --}}
    <div class="body-content">

        {{-- Intro paragraph ── --}}
        <p>
            Dengan segala hormatnya saya merujuk kepada perkara di atas dan surat daripada
            pihak {{ $application->developer->name }} bertarikh {{ $tarikh_surat_pemohon ?? '___________' }} adalah berkaitan.
        </p>

        {{-- Paragraph 2 ── --}}
        <div class="numbered-para">
            <span class="para-num">2.</span>
            <span class="para-text">
                Dimaklumkan bahawa pihak {{ $nama_majlis ?? 'Majlis' }} <strong>tiada halangan</strong> terhadap permohonan
                tersebut berdasarkan:-

                <div class="sub-points">
                    <table>
                        <tr>
                            <td class="sub-num">2.1</td>
                            <td>Tapak terletak di zon {{ $zon ?? 'gunatanah' }}; {{ $bpk ?? '' }}
                                berdasarkan Rancangan Tempatan {{ $nama_majlis ?? 'Majlis' }} {{ $tahun_rt ?? '' }};</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.2</td>
                            <td>Aktiviti yang dipohon merupakan aktiviti yang dibenarkan;</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.3</td>
                            <td>Pada pandangan {{ $nama_majlis_singkat ?? 'Majlis' }}, dari segi saiz dan kedudukan tanah sesuai
                                dimohon oleh agensi kerajaan;</td>
                        </tr>
                        <tr>
                            <td class="sub-num">2.4</td>
                            <td>Sebarang binaan dan kerja tanah perlu kelulusan {{ $nama_majlis ?? 'Majlis' }}
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

    {{-- ── Closing sentence ── --}}
    <div class="closing-line">
        Sekian dimaklumkan untuk tindakan pihak YBhg. Datuk / Tuan / Puan selanjutnya. Terima kasih.
    </div>

    {{-- ── Motto block ── --}}
    <div class="motto-block">
        <p>"<strong>{{ $motto_1 ?? 'BERKHIDMAT UNTUK NEGARA' }}</strong>"</p>
        @isset($motto_2)
        <p>"<strong>{{ $motto_2 }}</strong>"</p>
        @endisset
        @isset($motto_3)
        <p>"<strong>{{ $motto_3 }}</strong>"</p>
        @endisset
    </div>

    {{-- ── Signature block ── --}}
    <div class="signature-block">
        <p class="signature-label">Saya yang menjalankan amanah,</p>

        <div>
            <span class="signature-name">( {{ Auth::user()->name }} )</span>
            <p class="signature-title">{{ $jawatan_penandatangan ?? 'Yang Dipertua,' }}</p>
            <p class="signature-org">{{ $nama_organisasi ?? 'Majlis Perbandaran' }},</p>
            <p class="signature-org">{{ $negeri ?? 'Melaka' }}.</p>
        </div>
    </div>

</body>
</html>