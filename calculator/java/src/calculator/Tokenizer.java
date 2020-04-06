package calculator;

public class Tokenizer {

    private String _buffer;
    private Token currentToken;

    public Tokenizer(String text) {
        _buffer = text;
        next();
    }

    public void next() {
        _buffer = _buffer.trim();
        
         if (_buffer.isEmpty()) {
            currentToken = null;
            return;
         }
         
        char firstChar = _buffer.charAt(0);
        if (firstChar=='+') {
            currentToken = new Token("+", Token.Type.ADD);
        }
        if (firstChar=='-') {
            currentToken = new Token("-", Token.Type.SUB);
        }
        if (firstChar=='*') {
            currentToken = new Token("*", Token.Type.MUL);
        }
        if (firstChar=='/') {
            currentToken = new Token("/", Token.Type.DIV);
        }
        if (firstChar=='(') {
            currentToken = new Token("(", Token.Type.LBRA);
        }
        if (firstChar==')') {
            currentToken = new Token(")", Token.Type.RBRA);
        }
        if(Character.isDigit(firstChar)) {
            String num = "";
            for (int i = 0; i < _buffer.length(); i++) {
                firstChar = _buffer.charAt(i);
                if (Character.isDigit(firstChar)) {
                    num += String.valueOf(firstChar);
                } else {
                    break;
                }
            }
            currentToken = new Token(num, Token.Type.INT);
        }

        int tokenLen = currentToken.token().length();
        _buffer = _buffer.substring(tokenLen);
    }

    public Token current() {
        return currentToken;
    }

    public boolean hasNext() {
        return currentToken != null;
    }
}
