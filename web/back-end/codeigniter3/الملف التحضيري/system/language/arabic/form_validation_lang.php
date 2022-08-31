<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= 'الحقل {field} إجباري.';
$lang['form_validation_isset']			= 'الحقل {field} يجب أن يحتوي على قيمة.';
$lang['form_validation_valid_email']		= 'الحقل {field} يجب أن يحتوي عنوان بريد إلكتروني صحيح.';
$lang['form_validation_valid_emails']		= 'الحقل {field} يجب أن يحتوي عناوين بريد إلكتروني صحيحة.';
$lang['form_validation_valid_url']		= 'الحقل {field} يجب أن يحتوي على رابط.';
$lang['form_validation_valid_ip']		= 'الحقل {field} يجب أن يحتوي على عنوان أي بي.';
$lang['form_validation_min_length']		= 'الحقل {field} يجب أن لا يقل عن {param} حرف.';
$lang['form_validation_max_length']		= 'الحقل {field} يجب أن لا يتجاوز أكثر من {param} حرف.';
$lang['form_validation_exact_length']		= 'الحقل {field} يجب أن يكون بطول {param} حرف.';
$lang['form_validation_alpha']			= 'الحقل {field} يمكن أن يحتوي على أحرف فقط.';
$lang['form_validation_alpha_numeric']		= 'الحقل {field}  يمكن أن يحتوي على أحرف وأرقام فقط بلغة الانكليزية فقط.';
$lang['form_validation_alpha_numeric_spaces']	= 'الحقل {field} يمكن أن يحتوي أحرفا وأرقاما و فراغاتِ فقط.';
$lang['form_validation_alpha_dash']		= 'الحقل {field} يمكن أن يحتوي أحرفا وأرقاما أو شرطة أو شرطة سفلية.';
$lang['form_validation_numeric']		= 'الحقل {field} يجب أن يحتوي أرقاما فقط.';
$lang['form_validation_is_numeric']		= 'الحقل {field} يجب أن يحتوي أرقاما فقط.';
$lang['form_validation_integer']		= 'الحقل {field} يجب أن يحتوي رقما صحيح فقط.';
$lang['form_validation_regex_match']		= 'الحقل {field} لا يحتوي قيمة بشكل صحيح.';
$lang['form_validation_matches']		= 'الحقل {field} لا يساوي الحقل {param}.';
$lang['form_validation_differs']		= 'الحقل {field} يجب أن يكون مختلف عن الحقل {param}.';
$lang['form_validation_is_unique'] 		= 'الحقل {field} يجب أن يحتوي قيةً غير متكررة.';
$lang['form_validation_is_natural']		= 'الحقل {field} يجب أن يحتوي رقما.';
$lang['form_validation_is_natural_no_zero']	= 'الحقل {field} يجب أن يحتوي رقما أكبر من صفر.';
$lang['form_validation_decimal']		= 'الحقل {field} يجب أن يحتوي رقما عشريا.';
$lang['form_validation_less_than']		= 'الحقل {field} يجب أن يحتوي رقما أقل من {param}.';
$lang['form_validation_less_than_equal_to']	= 'الحقل {field} يجب أن يحتوي رقما أقل أو يساوي {param}.';
$lang['form_validation_greater_than']		= 'الحقل {field} يجب أن يحتوي رقما أكبر من {param}.';
$lang['form_validation_greater_than_equal_to']	= 'الحقل {field} يجب أن يحتوي رقما أكبر من أو يساوي {param}.';
$lang['form_validation_error_message_not_set']	= ' الحقل{field}  غير قادر على الوصول إلى رسالة خطأ المقابلة ل اسم مجال عملك.';
$lang['form_validation_in_list']		= 'الحقل {field} يجب أن يكون أحد: {param}.'; //FIXME