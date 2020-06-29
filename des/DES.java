/**
javac -encoding UTF-8 DES.java
java -Dfile.encoding=UTF-8 DES
javac -encoding UTF-8 DES.java && java -Dfile.encoding=UTF-8 DES
*/
import java.util.Scanner;

public class DES {

    static int LOOP_NUM = 16; // 16 轮迭代

    static byte[] IP = {
        58, 50, 42, 34, 26, 18, 10, 2,
        60, 52, 44, 36, 28, 20, 12, 4,
        62, 54, 46, 38, 30, 22, 14, 6,
        64, 56, 48, 40, 32, 24, 16, 8,
        57, 49, 41, 33, 25, 17,  9, 1,
        59, 51, 43, 35, 27, 19, 11, 3,
        61, 53, 45, 37, 29, 21, 13, 5,
        63, 55, 47, 39, 31, 23, 15, 7
    };

    static byte[] FP = {
        40, 8, 48, 16, 56, 24, 64, 32,
        39, 7, 47, 15, 55, 23, 63, 31,
        38, 6, 46, 14, 54, 22, 62, 30,
        37, 5, 45, 13, 53, 21, 61, 29,
        36, 4, 44, 12, 52, 20, 60, 28,
        35, 3, 43, 11, 51, 19, 59, 27,
        34, 2, 42, 10, 50, 18, 58, 26,
        33, 1, 41,  9, 49, 17, 57, 25
    };

    static byte[] PC1 = {
        57, 49, 41, 33, 25, 17,  9,  1,
        58, 50, 42, 34, 26, 18, 10,  2,
        59, 51, 43, 35, 27, 19, 11,  3,
        60, 52, 44, 36, 63, 55, 47, 39,
        31, 23, 15,  7, 62, 54, 46, 38,
        30, 22, 14,  6, 61, 53, 45, 37,
        29, 21, 13,  5, 28, 20, 12,  4
    };

    static byte[] PC2 = {
        14, 17, 11, 24,  1,  5,  3, 28,
        15,  6, 21, 10, 23, 19, 12,  4,
        26,  8, 16,  7, 27, 20, 13,  2,
        41, 52, 31, 37, 47, 55, 30, 40,
        51, 45, 33, 48, 44, 49, 39, 56,
        34, 53, 46, 42, 50, 36, 29, 32,
    };

    static byte[] E = {
        32,  1,  2,  3,  4,  5,
         4,  5,  6,  7,  8,  9,
         8,  9, 10, 11, 12, 13,
        12, 13, 14, 15, 16, 17,
        16, 17, 18, 19, 20, 21,
        20, 21, 22, 23, 24, 25,
        24, 25, 26, 27, 28, 29,
        28, 29, 30, 31, 32,  1
    };

    static byte[] P = {
        16,  7, 20, 21, 29, 12, 28, 17,
         1, 15, 23, 26,  5, 18, 31, 10,
         2,  8, 24, 14, 32, 27,  3,  9,
        19, 13, 30,  6, 22, 11,  4, 25
    };

    static byte[] R = {
        1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1
    };

    static byte[][] S = {
        {
            14,  4, 13, 1,  2, 15, 11,  8,  3, 10,  6, 12,  5,  9, 0,  7,
             0, 15,  7, 4, 14,  2, 13,  1, 10,  6, 12, 11,  9,  5, 3,  8,
             4,  1, 14, 8, 13,  6,  2, 11, 15, 12,  9,  7,  3, 10, 5,  0,
            15, 12,  8, 2,  4,  9,  1,  7,  5, 11,  3, 15, 10,  0, 6, 13
        },
        {
            15,  1,  8, 14,  6, 11,  3,  4,  9, 7,  2, 13, 12,  0,  5, 10,
             3, 13,  4,  7, 15,  2,  8, 14, 12, 0,  1, 10,  6,  9, 11,  5,
             0, 14,  7, 11, 10,  4, 13,  1,  5, 8, 12,  6,  9,  3,  2, 15,
            13,  8, 10,  1,  3, 15,  4,  2, 11, 6,  7, 12,  0,  5, 14,  9
        },
        {
            10,  0,  9, 14, 6,  3, 15,  5,  1, 13, 12,  7, 11,  4,  2,  8,
            13,  7,  0,  9, 3,  4,  6, 10,  2,  8,  5, 14, 12, 11, 15,  1,
            13,  6,  4,  9, 8, 15,  3,  0, 11,  1,  2, 12,  5, 10, 14,  7,
             1, 10, 13,  0, 6,  9,  8,  7,  4, 15, 14,  3, 11,  5,  2, 12
        },
        {
             7, 13, 14, 3,  0,  6,  9, 10,  1, 2, 8,  5, 11, 12,  4, 15,
            13,  8, 11, 5,  6, 15,  0,  3,  4, 7, 2, 12,  1, 10, 14,  9,
            10,  6,  9, 0, 12, 11,  7, 13, 15, 1, 3, 14,  5,  2,  8,  4,
             3, 15,  0, 6, 10,  1, 13,  8,  9, 4, 5, 11, 12,  7,  2, 14
        },
        {
             2, 12,  4,  1,  7, 10, 11,  6,  8,  5,  3, 15, 13, 0, 14,  9,
            14, 11,  2, 12,  4,  7, 13,  1,  5,  0, 15, 10,  3, 9,  8,  6,
             4,  2,  1, 11, 10, 13,  7,  8, 15,  9, 12,  5,  6, 3,  0, 14,
            11,  8, 12,  7,  1, 14,  2, 13,  6, 15,  0,  9, 10, 4,  5,  3
        },
        {
            12,  1, 10, 15, 9,  2,  6,  8,  0, 13,  3,  4, 14,  7,  5, 11,
            10, 15,  4,  2, 7, 12,  9,  5,  6,  1, 13, 14,  0, 11,  3,  8,
             9, 14, 15,  5, 2,  8, 12,  3,  7,  0,  4, 10,  1, 13, 11,  6,
             4,  3,  2, 12, 9,  5, 15, 10, 11, 14,  1,  7,  6,  0,  8, 13
        },
        {
             4, 11,  2, 14, 15, 0,  8, 13,  3, 12, 9,  7,  5, 10, 6,  1,
            13,  0, 11,  7,  4, 9,  1, 10, 14,  3, 5, 12,  2, 15, 8,  6,
             1,  4, 11, 13, 12, 3,  7, 14, 10, 15, 6,  8,  0,  5, 9,  2,
             6, 11, 13,  8,  1, 4, 10,  7,  9,  5, 0, 15, 14,  2, 3, 12
        },
        {
            13,  2,  8, 4,  6, 15, 11,  1, 10,  9,  3, 14,  5,  0, 12,  7,
             1, 15, 13, 8, 10,  3,  7,  4, 12,  5,  6, 11,  0, 14,  9,  2,
             7, 11,  4, 1,  9, 12, 14,  2,  0,  6, 10, 13, 15,  3,  5,  8,
             2,  1, 14, 7,  4, 10,  8, 13, 15, 12,  9,  0,  3,  5,  6, 11
        }
    };

    /**
     * 获取 整数 num 的第 i 位的值
     */
    public static boolean getBit(long num, int i)
    {
        return ((num & (1 << i)) != 0); // true 表示第i位为1,否则为0
    }

    /**
     * 将 整数 num 的第 i 位的值 置为 1
     */
    public static long setBit1(long num, int i) {
        return (num | (1 << i));
    }

    /**
     * 将 整数 num 的第 i 位的值 置为 0
     */
    public static long setBit0(long num, int i) {
       int mask = ~(1 << i); // 000100
       return (num & (mask)); // 111011
    }

    public static long setBit(long num, int i, boolean one) {
        if (one) {
            return setBit1(num, i);
        }
        return setBit0(num, i);
    }

    /**
     * 交换两个二进制位
     */
    public static long switchBit(long num, int i1, int i2) {
        boolean s1;
        boolean s2;
        s1 = getBit(num, i1);
        s2 = getBit(num, i2);
        num = setBit(num, i2, s1);
        num = setBit(num, i1, s2);
        return num;
    }

    /**
     * 把八个byte转换为一个long
     */
    public static long byte2long(byte[] input, int offset) {
        long value = 0;
        // 循环读取每个字节通过移位运算完成long的8个字节拼装
        for (int count = 0; count < 8; ++count) {
            // int shift = (littleEndian ? count : (7 - count)) << 3;
            int shift = (7 - count) << 3;
            value |= ((long)0xff << shift) & ((long)input[offset+count] << shift);
        }
        return value;
    }

    /**
     * 把字符串转换为 byte 数组
     */
    public static byte[] str2byte(String str) {
        byte[] b;
        byte[] b2;
        int i;
        b = str.getBytes();
        if (b.length < 8) {
            b2 = new byte[8];
            for (i = 0; i < 8; i++) {
                if (i >= b.length ) {
                    b2[i] = 0;
                } else {
                    b2[i] = b[i];
                }
            }
            b = b2;
        }
        if (b.length > 8) {
            int remainder;
            remainder = 8 - b.length % 8;
            if (remainder != 0) {
                int len = b.length + remainder;
                b2 = new byte[len];
                for (i = 0; i < len; i++) {
                    if (i >= b.length ) {
                        b2[i] = 0;
                    } else {
                        b2[i] = b[i];
                    }
                }
                b = b2;
            }
        }

        return b;
    }

    /**
     * 用 0 填充 long 的剩余位数
     */
    public static long longSetZero(long num, int start, int end) {
        for (int i = start; i < end; i++) {
            num = setBit0(num, i);
        }
        return num;
    }

    /**
     * 复制 bit 位
     */
    public static long copyBit(long num, int start, int end) {
        long tag = 0;
        for (int i = start; i < end; i++) {
            boolean bit = getBit(num, i);
            tag = setBit(tag, i, bit);
        }
        return tag;
    }

    /**
     * 合并两个 long 到一个 long 里
     */
    public static long mergeBit(long a, long b, int offset) {
        long ab;
        ab = a;
        ab = ab << offset;
        ab = ab | b;
        return ab;
    }

    /**
     * 把 long 数组转换成 byte 数组
     */
    public static byte[] mergeBlock(long[] block) {
        byte[] result = new byte[block.length * 8];
        for (int i = 0; i < block.length; i++) {
            System.arraycopy(long2Bytes(block[i]), 0, result, 8 * i, 8);
        }
        return result;
    }

    /**
     * 把 long 转为成 byte
     */
    public static byte[] long2Bytes(long num) {
        byte[] byteNum = new byte[8];
        for (int ix = 0; ix < 8; ++ix) {
            int offset = 64 - (ix + 1) * 8;
            byteNum[ix] = (byte) ((num >> offset) & 0xff);
        }
        return byteNum;
    }

    /**
     * pc1 置换
     */
    public static long[] pc1(long key) {
        for (int i = 0; i < PC1.length; i++) {
            key = switchBit(key, i, PC1[i] - 1);
        }
        key = longSetZero(key, 48, 64);
        long d;
        long c;
        d = copyBit(key, 0, 28);
        c = copyBit(key, 28, 56);
        long[] arr = new long[2];
        arr[0] = c;
        arr[1] = d;
        return arr;
    }

    /**
     * 左移
     */
    public static long left(long key, int offset) {
        for (int i = 0; i < offset; i++) {
            boolean bit = getBit(key, i);
            key = key << 1;
            key = setBit(key, 63 - i, bit);
        }
        return key;
    }

    /**
     * pc2 置换
     */
    public static long pc2(long cd) {
        return cd;
    }

    /**
     * 初始置换
     */
    public static long ip(long block) {
        return block;
    }

    /**
     * 逆初始置换
     */
    public static long fp(long block) {
        return block;
    }

    /**
     * 把需要 加密/解密 的数据分成 l r 两块
     */
    public static long[] lr(long block) {
        long[] arr = new long[2];
        arr[0] = (block << 32) >> 32;
        arr[1] = block >> 32;
        return arr;
    }

    /**
     * E 盒置换
     */
    public static long ebox(long r) {
        return r;
    }

    /**
     * S 置换
     */
    public static long sbox(long r, int i) {
        return r;
    }

    /**
     * P 置换
     */
    public static long pbox(long r) {
        return r;
    }

    /**
     * 生成子密钥
     */
    public static long[] generateKeys(byte[] passwd) throws Exception {

        if (passwd.length > 8) { // 如果密钥大于 64 位会抛出异常
            throw new Exception("password needs to be less than or equal to 8 bytes");
        }

        long[] keySub = new long[LOOP_NUM];
        if (passwd.length < 8) { // 如果密钥不足 64 位，就用 0 补足 64 位
            byte[] passwd2 = new byte[8];
            for (int i = 0; i < 8; i++) {
                if (i >= passwd.length ) {
                    passwd2[i] = 0;
                } else {
                    passwd2[i] = passwd[i];
                }
            }
            passwd = passwd2;
        }
        printbyte(passwd);

        long key = byte2long(passwd, 0); // 把 byte 数组转换为 long
        long[] arr;
        arr = pc1(key); // pc1 置换
        long c;
        long d;
        long cd;
        c = arr[0];
        d = arr[1];

        for (int i = 0; i < LOOP_NUM; i++) {
            // 左移
            c = left(c, R[i]);
            d = left(d, R[i]);
            // 合并cd 28
            cd = mergeBit(c, d, 28);
            // pc2 置换
            keySub[i] = pc2(cd);
        }

        return keySub;
    }

    public static long floop(long l, long r, int i, long keySub) {

        r = ebox(r); // E 盒置换
        r = r ^ keySub; // 48位子密钥异或
        r = sbox(r, i); // S 置换
        r = pbox(r); // P 置换
        l = l ^ r; // 32位 l 异或

        return l;
    }

    public static long feistel(long block, long[] keySub, boolean decryption) {

        long[] arr;
        long l, r, m;
        int i;

        // 初始置换
        block = ip(block);
        // 把需要 加密/解密 的数据分成 l r 两块
        arr = lr(block);
        l = arr[0];
        r = arr[1];

        if (decryption) { // 加密
            for (i = 0; i < LOOP_NUM; i++) {
                m = r;
                r = floop(l, r, i, keySub[i]);
                l = m;
            }
        } else { // 解密  反向迭代
            for (i = LOOP_NUM - 1; i >= 0; i--) {
                m = r;
                r = floop(l, r, i, keySub[i]);
                l = m;
            }
        }

        // 合并 l r 32
        block = mergeBit(l, r, 32);
        // 逆初始置换
        block = fp(block);

        return block;
    }

    /**
     * 加密/解密 用的是同一套算法，但子密钥的调用顺序相反
     */
    public static byte[] encrypt(byte[] src, long[] keySub, boolean decryption) {
        long[] tag;
        int i, j;
        byte[] result;

        // 分组
        tag = new long[src.length / 8];
        for (i = 0, j = 0; i < src.length; i = i + 8, j++) {
            tag[j] = byte2long(src, i);
        }

        // 编码
        for (i = 0; i < tag.length; i++) {
            tag[i] = feistel(tag[i], keySub, decryption);
        }

        // 合并
        result = mergeBlock(tag);

        return result;
    }

    /**
     * 加密
     */
    public static byte[] desEncode(byte[] src, long[] keySub) {
        boolean decryption = true;
        return encrypt(src, keySub, decryption);
    }

    /**
     * 解密
     */
    public static byte[] desDecode(byte[] src, long[] keySub) {
        boolean decryption = false;
        return encrypt(src, keySub, decryption);
    }

    /**
     * 输出 byte 数组
     */
    public static void printbyte(byte[] b) {
        System.out.print("\n-------\n");
        for (int i = 0; i < b.length; i++) {
            System.out.print(b[i] + " ");
            if ((i + 1) % 8 == 0) {
                System.out.print("\n");
            }
        }
        System.out.print("\n-------\n");
    }

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        String mode, password, cleartext, ciphertext;
        byte[] clear, cipher;
        long[] keySub = new long[LOOP_NUM];
        while (true) {
            // 只支持单字节字符集 请选择模式 1. 加密 2. 解密 3. 退出
            System.out.println("only single byte encoding is supported\nplease select mode\n1. encrypt\t2. decrypt\t3. exit");
            mode = input.nextLine(); // 从控制台获取模式
            if (mode.equals("1") || mode.equals("2")) {
                // 从控制台获取密钥
                System.out.println("input password");
                password = input.nextLine();

                try {
                    keySub = generateKeys(password.getBytes()); // 把密钥解释成 16 个子密钥
                } catch (Exception e) { // 如果密钥大于 64 位会抛出异常，然后继续主程序循环
                    System.out.println("\n" + e.toString() + "\n");
                    continue;
                }

                if (mode.equals("1")) { // 加密模式
                    // 从控制台获取明文
                    System.out.println("input cleartext");
                    cleartext = input.nextLine();

                    clear = str2byte(cleartext); // 把 string 转换成 byte 数组
                    printbyte(clear); // 输出转换成 byte 数组的明文，主要是测试用的
                    cipher = desEncode(clear, keySub); // 加密
                    printbyte(cipher); // 输出转换成 byte 数组的密文，主要是测试用的
                    System.out.println((new String(cipher))); // 输出密文字符串，可能是乱码
                } else { // 解密模式
                    // 从控制台获取密文
                    System.out.println("input ciphertext");
                    ciphertext = input.nextLine();

                    cipher = str2byte(ciphertext); // 把 string 转换成 byte 数组
                    printbyte(cipher); // 输出转换成 byte 数组的密文，主要是测试用的
                    clear = desEncode(cipher, keySub); // 解密
                    printbyte(clear); // 输出转换成 byte 数组的明文，主要是测试用的
                    System.out.println((new String(clear))); // 输出明文字符串
                }
            } else if (mode.equals("3")) { // 退出程序
                break;
            } else { // 未知参数，继续主程序循环
                continue;
            }
        }
        input.close();
    }
}
