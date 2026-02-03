<?php

namespace App\Enum;

enum Category: string
{
    case SaranaPrasarana = "Sarana & Prasarana (Fasilitas)";
    case KebersihanLingkungan = "Kebersihan & Lingkungan";
    case KeamananKetertiban = "Keamanan & Ketertiban";
    case KedisiplinanTataTertib = "Kedisiplinan & Tata Tertib";
    case AdministrasiSekolah = "Administrasi Sekolah";
    case KegiatanSiswaOrganisasi = "Kegiatan Siswa & Organisasi";
    case KonselingKesejahteraanSiswa = "Konseling & Kesejahteraan Siswa";
    case Kesehatan = "Kesehatan";
    case TransportasiAkses = "Transportasi & Akses";
    case SaranIdeInovasi = "Saran & Ide (Inovasi)";
    case Lainnya = "Lainnya";
}
