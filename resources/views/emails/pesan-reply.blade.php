<x-mail::message>
    # Halo, {{ $pesan->nama }}

    Terima kasih telah menghubungi kami. Berikut adalah tanggapan dari Admin DPMD Kabupaten Manggarai Timur mengenai
    pesan Anda:

    <x-mail::panel>
        {{ $replyMessage }}
    </x-mail::panel>

    ---
    **Pesan Asal Anda:**
    > {{ $pesan->pesan }}

    Terima kasih,<br>
    Admin DPMD Kabupaten Manggarai Timur
</x-mail::message>