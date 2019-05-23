using System;
using GPorject.Models;
using Newtonsoft.Json;
using Microsoft.AspNetCore.Http;

namespace GPorject.BLL
{
	public static class Helper
	{
		public static long GetTimeStamp()
		{
			return (DateTime.Now.ToUniversalTime().Ticks - 621355968000000000) / 10000000;
		}

		/// <summary>
		/// 字符串转换整形数组
		/// </summary>
		/// <param name="str">字符串</param>
		/// <returns></returns>
		public static int[] ToIntArray(string str)
		{
			// 字符串转字符串数组
			string[] strArray = str.Split(',');
			// 字符串数组转整型数组
			int[] c = new int[strArray.Length];
			for (int i = 0; i < strArray.Length; i++)
			{
				c[i] = Convert.ToInt32(strArray[i].ToString());
			}
			return c;
		}
	}
}
