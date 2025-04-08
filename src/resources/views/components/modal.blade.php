@props(['order_id'])
<div {{ $attributes->merge(['class' => 'modal__overlay']) }}>
<form class="modal" action="{{ route('tradingMessage.complete') }}" method="POST">
    @csrf
    <div class="modal__title">取引が完了しました。</div>
    <div class="modal__content">今回の取引相手はどうでしたか?</div>
    <div class="modal__rating">
        @foreach (range(1,5) as $i)
        <img src="{{ asset('img/star-gray.svg') }}" class="modal__star" onclick="setRating({{ $i }})">
        @endforeach
    </div>
    <div class="modal__button">
        <input type="hidden" name="rating" id="rating" value="">
        <input type="hidden" name="order_id" value="{{$order_id}}">
        <button type="submit" class="modal__submit">送信する</button>
    </div>
</form>
</div>
<script>
    function setRating(rating) {
        const stars = document.querySelectorAll('.modal__star');
        stars.forEach((star, index) => {
            star.src = index < rating ? '{{ asset('img/star-yellow.svg') }}' : '{{ asset('img/star-gray.svg') }}';
        });
        document.getElementById('rating').value = rating;
    }
</script>