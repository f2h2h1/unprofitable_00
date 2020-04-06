package calculator;

/**
 * 这个类的主要目标是实现一个简单的解析器。
 * 它应该能够解析以下语法规则：
 * <exp> ::= <term> | <term> + <exp> | <term> - <exp>
 * <term> ::= <factor> | <factor> * <term> | <factor> / <term>
 * <factor> ::= <unsigned integer> | ( <exp> )
 */
public class Parser {

    Tokenizer _tokenizer;

    public Parser(Tokenizer tokenizer) {
        _tokenizer = tokenizer;
    }

    public Exp parseExp() {
        Exp value = parseTerm();
        if (_tokenizer.hasNext()) {
            if (_tokenizer.current().token().equals("+")) {
                _tokenizer.next();
                value = new AddExp(value, parseExp());
            } else if (_tokenizer.current().token().equals("-")) {
                _tokenizer.next();
                value = new SubExp(value, parseExp());
            }
        }
        return value;
    }

    public Exp parseTerm() {
        Exp value = parseFactor();
        if (_tokenizer.hasNext()) {
            if (_tokenizer.current().token().equals("*")) {
                _tokenizer.next();
                value = new MultExp(value, parseTerm());
            } else if (_tokenizer.current().token().equals("/")) {
                _tokenizer.next();
                value = new DivExp(value, parseTerm());
            }
        }
        return value;
    }

    public Exp parseFactor() {
        Exp value;
        if (_tokenizer.current().token().equals("(")) {
            _tokenizer.next();
            value = parseExp();
            _tokenizer.next();
        } else {
            value = new IntExp(Integer.valueOf(_tokenizer.current().token()));
            _tokenizer.next();
        }
        return value;
    }
}
