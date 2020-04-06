package calculator;

public class IntExp extends Exp {

    private Integer value;

    public IntExp(Integer value) {
        this.value = value;
    }

    @Override
    public String show() {
        return value.toString();
    }

    @Override
    public int evaluate() {
        return value;
    }
}
