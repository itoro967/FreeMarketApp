<div class="correct-modal__overlay" onclick="modalClose()">
<form class="correct-modal" action="{{ route('tradingMessage.correct') }}" method="POST" onclick="event.stopPropagation()">
@csrf
<input type="text" name="message" class="correct-message">
<input type="hidden" name="message_id" class="correct-message-id" value="">
<button type="submit" class="correct-modal__button">修正</button>
</form>
</div>
<script>
    function modalClose() {
        console.log('close');
        const correctModal = document.querySelector('.correct-modal__overlay');
        correctModal.classList.remove('correct-modal__overlay--active');
    }
</script>