const quote = document.querySelector('#quote');
const quoteMaxLength = 60;

const checkQuoteLength = () => {
    if(quote.value.length <= quoteMaxLength) {
        return true;
    } else {
        quote.value = quote.value.substr(0, quoteMaxLength);
        return false;
    }
}

quote.addEventListener('keyup', () => checkQuoteLength())