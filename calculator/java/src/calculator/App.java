package calculator;

import java.util.Scanner;

public class App {
    public static void main(String[] args) throws Exception {
        String input;
        Scanner in;
        do {
            System.out.print("> ");
            in = new Scanner(System.in);
            input = in.nextLine();
            if (input.equals("exit")) {
                break;
            }
            Tokenizer tokenizer = new Tokenizer(input);
            Parser parser = new Parser(tokenizer);
            Exp exp = parser.parseExp();
            exp.evaluate();
            System.out.println("> " + exp.evaluate());
        } while (true);
        in.close();
    }
}
