/*
课程名 二叉排序树
树结构  成绩 左节点 右节点 head
链表中的节点 学号 姓名 专业 next

查询
    按课程查询 输出该课程所有成绩，学号，姓名，专业
    按学号查询 输出该学生，课程成绩，姓名，专业
    按姓名查询 输出该学生学号，课程成绩，专业

插入一个新学生信息 从头指针插入
删除一个学生及其信息 删除所有信息
按专业各个课程成绩排序 高到低 输出 成绩 学号 姓名
各个看课程成绩统计 不及格 及格的各个分数段人数 每10分为一个段 0-9


姓名可能重复，学号不会重复



1. 课程设计的内容要求
2. 数据结构
    包括，任务的总体数据结构；采用各个节点的定义形式以及对应她们的c语言的定义等
3. 任务的总体结构和算法描述
4. 程序代码说明
    文档里有说明，代码里有注释
    程序代码中全局变量的含义说明；所有函数的功能说明
5. 程序主要代码
6. 主要功能实现的结果展示
7. 自我评价和体会

源码和控制台的输入输出都使用gbk编码

三个课程
    数据结构
    操作系统
    数据库原理
六个专业
    计算机科学与技术 1
    软件工程 2
    网络工程 3
    信息安全 4
    物联网工程 5
    数字媒体技术 6
七十二个学生

一个课程两个专业
一个专业十二个个学生


结构体，结构体之间的联系，初始化数据
查找二叉数插入节点
二叉数的中序遍历
查找二叉数的删除节点

先删除成绩二叉树里的数据，再删除学生链表里的数据


gcc binarytreescore.c -o binarytreescore

*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include <stdbool.h>

#ifndef _WIN32                   // Linux platform
    #include <termio.h>
    #ifndef STDIN_FILENO
        #define STDIN_FILENO 0
    #endif
    int getch(void) {
        struct termios tm, tm_old;
        int fd = STDIN_FILENO, c;
        if(tcgetattr(fd, &tm) < 0)
            return -1;
        tm_old = tm;
        cfmakeraw(&tm);
        if(tcsetattr(fd, TCSANOW, &tm) < 0)
            return -1;
        c = fgetc(stdin);
        if(tcsetattr(fd, TCSANOW, &tm_old) < 0)
            return -1;
        return c;
    }
#else                            // WIN32 platform
    #include <conio.h>
#endif
void sys_pause()
{
    puts("Press any key to continue ...");
    getch();
}

#ifdef _WIN32
    #include <windows.h>
#else
    #include <unistd.h>
#endif

#define STUDNET_COUNT 12 // 每个专业有十二个学生
#define CLASS_COUNT 3 // 一共有三个课程
#define SUBJECT_COUNT 6 // 一个有六个专业

char *ClassName[] = {
    "数据结构",
    "操作系统",
    "数据库原理"
};

char *Subject[] = {
    "计算机科学与技术",
    "软件工程",
    "网络工程",
    "信息安全",
    "物联网工程",
    "数字媒体技术"
};

typedef struct Student
{
    int number; // 学号
    char name[10]; // 学生姓名最长五个汉字
    char *subject; // 专业名
    struct Student *next;
} Student;

typedef struct Score
{
    int value; // 具体分数
    struct Student *student; // 分数对应的学生
    struct Score *lchild;
    struct Score *rchild;
} Score;

typedef struct Class
{
    char name[40]; // 课程名最长四十个汉字
    struct Score *score; // 成绩
    struct Class *next;
} Class;

void init(); // 初始化数据
void studentAdd(Student new); // 添加学生
bool studnetDel(int studentID); // 删除学生
bool studnetIDexist(int studentID); // 判断学号是否存在
void classScoreAdd(Class *class, Student *student, int score); // 添加课程成绩
Score* scoreInit(Student *student, int score); // 初始化成绩
void scoreAdd(Score *score, Student *student, int value); // 添加成绩
void scoreDel(Class *class, int studentID); // 删除成绩

// 这些是主菜单的实现函数
void queryClass(); // 按课程查询
void queryClassByStudentNumber(); // 按学号查询
void queryClassByStudentName(); // 按姓名查询
void addStudent(); // 插入一个新学生信息
void delStudent(); // 删除一个学生及其信息
void showScoreBySubject(); // 按专业各个课程成绩排序
void showScoreStatistics(); // 各个看课程成绩统计

Class *classLink = NULL; // 课程链表
Student *studentLink = NULL; // 学生链表
char c; // 用于清除输入缓冲区

Score* scoreInit(Student *student, int value) {
    Score *score = (Score*)malloc(sizeof(Score));
    score->student = student;
    score->value = value;
    score->lchild = NULL;
    score->rchild = NULL;
    return score;
}

void scoreAdd(Score *score, Student *student, int value) {
    if (score->value <= value) {
        if (score->lchild == NULL) {
            score->lchild = scoreInit(student, value);
        } else {
            scoreAdd(score->lchild, student, value);
        }
    } else {
        if (score->rchild == NULL) {
            score->rchild = scoreInit(student, value);
        } else {
            scoreAdd(score->rchild, student, value);
        }
    }
}

void scoreDel(Class *class, int studentID) {
    Score *score = class->score;
    Score *root = score;

    if (root == NULL) {
        printf("根节点为空\n");
        return;
    }

    printf("根节点 %d %d\n", root->student->number, studentID);
    if (root->student->number == studentID) {
        printf("需要删除的是根节点\n");
        if (root->lchild == NULL) { // 如果左子树为空，则用右子树来替代根节点
            printf("左子树为空，则用右子树来替代根节点\n");
            class->score = root->rchild;
            free(root);
            return;
        }
        if (root->rchild == NULL) { // 如果右子树为空，则用左子树来替代根节点
            printf("右子树为空，则用左子树来替代根节点\n");
            class->score = root->lchild;
            free(root);
            return;
        }
        printf("根节点的左右子树都不为空\n");
        Score *current = root->lchild;
        if (current->rchild == NULL) { // 左子树的右节点为空，
            printf("左子树的右节点为空\n");
            class->score = root->lchild;
            class->score->rchild = root->rchild;
            free(root);
        }

        Score *pre = current;
        while (current->rchild != NULL) { // 寻找左子树的最大值
            printf("寻找左子树的最大值 %d %d\n", current->student->number, current->value);
            pre = current;
            current = current->rchild;
        }

        class->score = current;
        pre->rchild = current->lchild;
        current->lchild = root->lchild;
        current->rchild = root->rchild;

        free(root);
        return;
    }

    Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
    int top = -1;
    // 当score为NULL或者栈为空时，表明树遍历完成
    while (score != NULL || top  !=  -1) {
        // 如果score不为NULL，将其压栈并遍历其左子树
        if (score != NULL) {
            stack[++top] = score; // 压栈
            score = score->lchild;
        }
        // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
        else{
            score = stack[top]; // 获取栈顶
            if (top != -1) { // 出栈
                top--;
            }

            Score *parent = NULL;
            if (score->lchild != NULL && score->lchild->student->number == studentID) {
                parent = score;
                score = score->lchild;
            }

            if (score->rchild != NULL && score->rchild->student->number == studentID) {
                parent = score;
                score = score->rchild;
            }

            if (parent != NULL) {
                // 叶子节点；（直接删除节点即可）
                printf("找到需要删除的节点 学号：%d 成绩：%d\n", score->student->number, score->value);
                // printf("\nline %d\n", __LINE__);
                if (score->lchild == NULL && score->rchild == NULL) {
                    printf("叶子节点\n");
                    if (parent->lchild == score) {
                        parent->lchild = NULL;
                    } else if (parent->rchild == score) {
                        parent->rchild = NULL;
                    }
                    free(score);
                    return;
                }
                // 仅有左或者右子树的节点；（删除节点后，将它的左子树或者右子树整个移动到删除节点的位置）
                if (score->rchild == NULL || score->rchild == NULL) {
                    printf("仅有左或者右子树的节点\n");
                    if (parent->lchild == score) {
                        parent->lchild = parent->rchild;
                    } else if (parent->rchild == score) {
                        parent->rchild = parent->lchild;
                    }
                    free(score);
                    return;
                }

                // 左右子树都有的节点
                // 用 左子树的最大值 或 右子树的最小值 替代被删除的节点
                printf("左右子树都有的节点\n");
                Score *current = score->lchild;
                if (current->rchild == NULL) { // 左子树的右节点为空，
                    printf("左子树的右节点为空\n");
                    if (parent->lchild == score) {
                        parent->lchild = score->lchild;
                    } else if (parent->rchild == score) {
                        parent->rchild = score->lchild;
                    }
                    score->lchild->rchild = score->rchild;
                    free(score);
                    return;
                }

                Score *pre = current;
                while (current->rchild != NULL) { // 寻找左子树的最大值
                    printf("寻找左子树的最大值 %d %d\n", current->student->number, current->value);
                    pre = current;
                    current = current->rchild;
                }

                
                if (parent->lchild == score) {
                    parent->lchild = current;
                } else if (parent->rchild == score) {
                    parent->rchild = current;
                }
                pre->rchild = current->lchild;
                current->lchild = score->lchild;
                current->rchild = score->rchild;

                free(score);
                return;
            }
            score = score->rchild;
        }
    }

    printf("未能成功触发删除代码\n");
    printf("输出根节点 %d\n", studentID);

}

bool studnetDel(int studentID) {
    if (studentLink == NULL) {
        return false;
    }

    Student *current = studentLink;
    if (current->number == studentID) {
        studentLink = current->next;
        free(current);
        return true;
    }

    Student *pre = current;
    current = current->next;
    while (current != NULL) {
        if (current->number == studentID) {
            pre->next = current->next;
            free(current);
            return true;
        }
        current = current->next;
        pre = pre->next;
    }
    return false;
}

bool studnetIDexist(int studentID) {
    Student *current = studentLink;
    while (current != NULL) {
        if (current->number == studentID) {
            return true;
        }
        current = current->next;
    }
    return false;
}

void classScoreAdd(Class *class, Student *student, int score) {
    if (class->score == NULL) {
        class->score = scoreInit(student, score);
    } else {
        scoreAdd(class->score, student, score);
    }
}

void studentAdd(Student new) {
    Student *temp = (Student*)malloc(sizeof(Student));
    temp->number = new.number;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        strcpy_s(temp->name, _countof(temp->name), new.name);
    #else
        strcpy(temp->name, new.name);
    #endif
    temp->subject = new.subject;
    if (studentLink == NULL) {
        studentLink = temp;
        studentLink->next = NULL;
    } else {
        temp->next = studentLink;
        studentLink = temp;
    }
}

void init()
{
    // 初始化学生数据
    char *familyName[] = {
        "姬", "姚", "嬴", "姜", "虞", "姒", "妘", "妫", "妊", "姞", "子", "依"
    };
    char *middleName[] = {
        "令", "广", "显", "德", "扬", "学", "昌", "友", "向", "明", "振", "裕"
    };
    char *lastName[] = {
        "钊", "铃", "枫", "桃", "沁", "沫", "浦", "灵", "煌", "煜", "堔", "堯"
    };
    srand((unsigned)time(NULL));
    for (int i = 0; i < SUBJECT_COUNT; i++) {
        for (int j = 0; j < STUDNET_COUNT; j++) {
            Student stu1;
            stu1.number = (i + 1) * 100 + j + 10;
            stu1.subject = Subject[i];
            #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
                strcpy_s(stu1.name, _countof(stu1.name), familyName[rand() % 12]);
                strcat_s(stu1.name, _countof(stu1.name), middleName[rand() % 12]);
                strcat_s(stu1.name, _countof(stu1.name), lastName[rand() % 12]);
            #else
                strcpy(stu1.name, familyName[rand() % 12]);
                strcat(stu1.name, middleName[rand() % 12]);
                strcat(stu1.name, lastName[rand() % 12]);
            #endif
            studentAdd(stu1);
            // printf("%d %d 学号：%d\t姓名：%s\t专业：%s\n", i, j, stu1.number, stu1.name, stu1.subject);
        }
    }

    // 初始化课程数据
    Class *class = (Class*)malloc(sizeof(Class));
    for (int i = 0; i < CLASS_COUNT; i++) {
        if (i == 0) {
            class->next = NULL;
        } else {
            Class *temp = (Class*)malloc(sizeof(Class));
            temp->next = class;
            class = temp;
        }
        #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
            strcpy_s(class->name, _countof(class->name), ClassName[i]);
        #else
            strcpy(class->name, ClassName[i]);
        #endif
        class->score = NULL;
    }
    classLink = class;

    // 初始化成绩数据
    srand((unsigned)time(NULL));
    Class *class5 = classLink;
    for (int i = 0; i < CLASS_COUNT; i++, class5 = class5->next) {
        Student *stuLink = studentLink;
        while (stuLink != NULL) {
            int score;
            if (rand() % 100 < 90) {
                score = rand() % 40 + 60; // 产生60~99的随机数
            } else {
                score = rand() % 50 + 10; // 产生10~59的随机数
            }
            // printf("学号：%d\t姓名：%s\t专业：%s\t课程：%s\t分数：%d\n", stuLink->number, stuLink->name, stuLink->subject, class5->name, score);
            classScoreAdd(class5, stuLink, score);
            stuLink = stuLink->next;
        }
    }
}

void queryClass() {

    Class *class = classLink;
    int i;
    for (i = 1; class != NULL; i++, class = class->next) { // 输出全部的课程名称
        printf("%d %s\n", i, class->name);
    }
    printf("请输入课程编号\n");
    int classID;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &classID);
    #else
        scanf("%d", &classID);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入
    if (!(classID >= 1 && classID <= CLASS_COUNT)) { // 判断输入的课程编号是否有效
        printf("无效输入\n");
        return;
    }

    class = classLink;
    for (i = 1; class != NULL; i++, class = class->next) { // 搜索二叉树的中序遍历，就是从高到低排序
        if (i == classID) {
            Score *score = class->score;
            Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
            int top = -1;
            // 当score为NULL或者栈为空时，表明树遍历完成
            while (score != NULL || top  !=  -1) {
                // 如果score不为NULL，将其压栈并遍历其左子树
                if (score != NULL) {
                    stack[++top] = score; // 压栈
                    score = score->lchild;
                }
                // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
                else{
                    score = stack[top]; // 获取栈顶
                    if (top != -1) { // 出栈
                        top--;
                    }

                    // 输出成绩
                    printf("学号：%d\t姓名：%s\t专业：%-16s\t课程：%-10s\t分数：%d\n",
                        score->student->number, score->student->name, score->student->subject, class->name, score->value);

                    score = score->rchild;
                }
            }
            break;
        }
    }

    sys_pause();
}

void queryClassByStudentNumber() {

    printf("请输入学号\n");
    int studentID;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &studentID);
    #else
        scanf("%d", &studentID);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入

    for (Class *class = classLink; class != NULL; class = class->next) { // 搜索二叉树的中序遍历，就是从高到低排序
        Score *score = class->score;
        Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
        int top = -1;
        // 当score为NULL或者栈为空时，表明树遍历完成
        while (score != NULL || top  !=  -1) {
            // 如果score不为NULL，将其压栈并遍历其左子树
            if (score != NULL) {
                stack[++top] = score; // 压栈
                score = score->lchild;
            }
            // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
            else{
                score = stack[top]; // 获取栈顶
                if (top != -1) { // 出栈
                    top--;
                }

                if (score->student->number == studentID) { // 当学号相等时就输出成绩，并退出循环
                    printf("学号：%d\t姓名：%s\t专业：%-16s\t课程：%-10s\t分数：%d\n",
                        score->student->number, score->student->name, score->student->subject, class->name, score->value);
                    break;
                }

                score = score->rchild;
            }
        }
    }

    sys_pause();
}

void queryClassByStudentName() {

    printf("请输入学生姓名\n");
    char studentName[10];
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%s", studentName, _countof(studentName));
    #else
        scanf("%s", studentName);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入

    for (Class *class = classLink; class != NULL; class = class->next) { // 搜索二叉树的中序遍历，就是从高到低排序
        Score *score = class->score;
        Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
        int top = -1;
        // 当score为NULL或者栈为空时，表明树遍历完成
        while (score != NULL || top  !=  -1) {
            // 如果score不为NULL，将其压栈并遍历其左子树
            if (score != NULL) {
                stack[++top] = score; // 压栈
                score = score->lchild;
            }
            // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
            else{
                score = stack[top]; // 获取栈顶
                if (top != -1) { // 出栈
                    top--;
                }

                if (strcmp(score->student->name, studentName) == 0) { // 当姓名相等时就输出成绩
                    printf("学号：%d\t姓名：%s\t专业：%-16s\t课程：%-10s\t分数：%d\n",
                        score->student->number, score->student->name, score->student->subject, class->name, score->value);
                }

                score = score->rchild;
            }
        }
    }

    sys_pause();
}

void addStudent() {

    printf("请输入学号\n");
    int studentID;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &studentID);
    #else
        scanf("%d", &studentID);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入

    // 判断学号是否有重复
    if (studnetIDexist(studentID)) {
        printf("学号已存在\n");
        return;
    }

    Student stu1; // 声明一个新的学生类型的变量
    stu1.number = studentID;

    printf("请选择这名学生所在的专业\n");
    for (int j = 0; j < SUBJECT_COUNT; j++) { // 输出全部的专业名称
        printf("%d. %s\n", j, Subject[j]);
    }
    int subjectIndex;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &subjectIndex);
    #else
        scanf("%d", &subjectIndex);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入
    stu1.subject = Subject[subjectIndex];
    if (!(subjectIndex >= 0 && subjectIndex < SUBJECT_COUNT)) { // 判断输入的专业编号是否有效
        printf("无效输入\n");
        return;
    }

    printf("请输入学生姓名\n");
    char studentName[10];
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", studentName, _countof(studentName));
    #else
        scanf("%s", studentName);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        strcpy_s(stu1.name, _countof(stu1.name), studentName);
    #else
        strcpy(stu1.name, studentName);
    #endif

    studentAdd(stu1); // 把新的学生变量加入的链表里

    printf("请输入成绩\n");
    Class *class = classLink;
    Student *stuLink = studentLink;
    for (; class != NULL; class = class->next) { // 给新的学生输入每一科的成绩
        printf("请输入 %s 的成绩：", class->name);
        int score;
        #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
            scanf_s("%d", &score);
        #else
            scanf("%d", &score);
        #endif
        while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入
        classScoreAdd(class, stuLink, score); // 把成绩加入到成绩的二叉排序树里
    }

    printf("新增成功\n");

    sys_pause();
}

void delStudent() {

    printf("请输入学号\n");
    int studentID;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &studentID);
    #else
        scanf("%d", &studentID);
    #endif
    while((c = getchar()) != '\n' && c != EOF);

    if (!studnetIDexist(studentID)) {
        printf("无效学号\n");
        return;
    }

    Class *class = classLink;
    for (int i = 1; class != NULL; i++, class = class->next) {
        printf("删除 %s 的成绩\n", class->name);
        scoreDel(class, studentID);
        printf("\n");
    }

    if (!studnetDel(studentID)) {
        printf("删除学生信息失败\n");
        return;
    }
    printf("删除学生信息成功\n");

    printf("删除成功\n");

    sys_pause();
}

void showScoreBySubject() {

    printf("请选择专业\n");
    for (int j = 0; j < SUBJECT_COUNT; j++) { // 输出全部的专业名称
        printf("%d. %s\n", j, Subject[j]);
    }
    int subjectIndex;
    #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
        scanf_s("%d", &subjectIndex);
    #else
        scanf("%d", &subjectIndex);
    #endif
    while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入
    if (!(subjectIndex >= 0 && subjectIndex < SUBJECT_COUNT)) { // 判断输入的专业编号是否有效
        printf("无效输入\n");
        return;
    }

    for (Class *class = classLink; class != NULL; class = class->next) { // 搜索二叉树的中序遍历，就是从高到低排序
        Score *score = class->score;
        Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
        int top = -1;
        // 当score为NULL或者栈为空时，表明树遍历完成
        while (score != NULL || top  !=  -1) {
            // 如果score不为NULL，将其压栈并遍历其左子树
            if (score != NULL) {
                stack[++top] = score; // 压栈
                score = score->lchild;
            }
            // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
            else{
                score = stack[top]; // 获取栈顶
                if (top != -1) { // 出栈
                    top--;
                }

                if (strcmp(score->student->subject, Subject[subjectIndex]) == 0) { // 只输出对应专业的记录
                    printf("学号：%d\t姓名：%s\t专业：%-16s\t课程：%-10s\t分数：%d\n",
                        score->student->number, score->student->name, score->student->subject, class->name, score->value);
                }

                score = score->rchild;
            }
        }
    }

    sys_pause();
}

void showScoreStatistics() {
    int section[5];  // 各个分数段人数，分成五段 不及格 60 ~ 70 70 ~ 80 80 ~ 90 90 ~ 100
    for (Class *class = classLink; class != NULL; class = class->next) {
        memset(section, 0, sizeof(int)*5);
        Score *score = class->score;
        Score *stack[STUDNET_COUNT*SUBJECT_COUNT];
        int top = -1;
        // 当score为NULL或者栈为空时，表明树遍历完成
        while (score != NULL || top  !=  -1) {
            // 如果score不为NULL，将其压栈并遍历其左子树
            if (score != NULL) {
                stack[++top] = score; // 压栈
                score = score->lchild;
            }
            // 如果score==NULL，表明左子树遍历完成，需要遍历上一层结点的右子树
            else{
                score = stack[top]; // 获取栈顶
                if (top != -1) { // 出栈
                    top--;
                }

                // 各个分数段人数
                if (score->value < 60) {
                    section[0]++;
                } else if (score->value >= 60 && score->value < 70) {
                    section[1]++;
                } else if (score->value >= 70 && score->value < 80) {
                    section[2]++;
                } else if (score->value >= 80 && score->value < 90) {
                    section[3]++;
                } else if (score->value >= 90 && score->value <= 100) {
                    section[4]++;
                }

                score = score->rchild;
            }
        }

        // 输出统计结果
        printf("%s：\n\t不及格：%d\n\t60 ~ 70：%d\n\t70 ~ 80：%d\n\t80 ~ 90：%d\n\t90 ~ 100：%d\n",
            class->name, section[0], section[1], section[2], section[3], section[4]);
    }

    sys_pause();
}

int main ()
{
    #ifdef _WIN32
        int chcp = GetConsoleCP(); // 获取控制台当前的输入编码
        int chcpOutput = GetConsoleOutputCP(); // 获取控制台当前的输出编码
        SetConsoleCP(936); // 把控制台的输入编码设为 936 ，就是 gbk
        SetConsoleOutputCP(936); // 把控制台的输出编码设为 936 ，就是 gbk
    #else
        char *LANG = getenv("LANG"); // 获取当前终端的编码
        system("export LANG zh_CN.GBK"); // 把当前终端的编码设为 gbk
    #endif

    init(); // 初始化数据
    while (true) {
        printf("\n--------------------------------\n");
        printf("1. 按课程查询\n");
        printf("2. 按学号查询\n");
        printf("3. 按姓名查询\n");
        printf("4. 插入一个新学生信息\n");
        printf("5. 删除一个学生及其信息\n");
        printf("6. 按专业各个课程成绩排序\n");
        printf("7. 各个看课程成绩统计\n");
        printf("0. 退出\n");
        printf("--------------------------------\n");

        int flg;
        #ifdef _MSC_VER // 这种ifdef是用来区分vc和gcc环境的
            scanf_s("%d", &flg);
        #else
            scanf("%d", &flg);
        #endif
        while((c = getchar()) != '\n' && c != EOF); // 清空缓冲区输入

        switch (flg) {
            case 1: queryClass();
                continue;
            case 2: queryClassByStudentNumber();
                continue;
            case 3: queryClassByStudentName();
                continue;
            case 4: addStudent();
                continue;
            case 5: delStudent();
                continue;
            case 6: showScoreBySubject();
                continue;
            case 7: showScoreStatistics();
                continue;
            case 0: goto endloop;
            default: continue;
        }
    }
    endloop:;

    #ifdef _WIN32
        SetConsoleCP(chcp); // 程序退出的时候把控制台的输入编码还原为原本的编码
        SetConsoleOutputCP(chcpOutput); // 程序退出的时候把控制台的输出编码还原为原本的编码
    #else
        char chatset[32];
        strcpy(chatset, "export LANG ");
        strcat(chatset, LANG); // 拼接命令
        system(chatset); // 把当前终端的编码还原为原本的编码
    #endif

    return 0;
}
