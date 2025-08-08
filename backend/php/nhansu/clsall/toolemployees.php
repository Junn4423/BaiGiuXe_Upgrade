<?php
class toolemployees
{
//Check Exist
var $isExist=null;
//Declare variant array
var $ArrTable=null;
//Declare variant message
var $Error=null;
var $Finish=null;
var $Count=null;
	function toolemployees()
	{
		$this->isExist=-1;
		$this->ArrTable=array();
		//Messages
		$this->ArrTable[0][0]="timecardx06.messages";
		$this->ArrTable[0][1]="UserID";		
		//LogEmp
		$this->ArrTable[1][0]="timecardx06.logemp";
		$this->ArrTable[1][1]="EmployeeID";		
		//tc_weekwork
		$this->ArrTable[2][0]="timecardx06.tc_weekwork";
		$this->ArrTable[2][1]="EmployeeID";		
		//tc_timesheet
		$this->ArrTable[3][0]="timecardx06.tc_timesheet";
		$this->ArrTable[3][1]="EmployeeID";		
		$this->ArrTable[3][2]="2";		
		//tc_loan
		$this->ArrTable[4][0]="timecardx06.tc_loan";
		$this->ArrTable[4][1]="EmployeeID";	
		$this->ArrTable[4][2]="3";				
		//tc_payroll
		$this->ArrTable[5][0]="timecardx06.tc_payroll";
		$this->ArrTable[5][1]="EmployeeID";		
		//tc_expenses
		$this->ArrTable[6][0]="timecardx06.tc_expenses";
		$this->ArrTable[6][1]="EmployeeID";		
		//tc_timeemployee
		$this->ArrTable[7][0]="timecardx06.tc_timeemployee";
		$this->ArrTable[7][1]="EmployeeID";		
		//EmployeeLogin
		$this->ArrTable[8][0]="EmployeeLogin";
		$this->ArrTable[8][1]="ID";		
		//tc_employeeinfor
		$this->ArrTable[9][0]="timecardx06.tc_employeeinfo";
		$this->ArrTable[9][1]="EmployeeID";		
		//tc_timeenter
		$this->ArrTable[10][0]="timecardx06.tc_timeenter";
		$this->ArrTable[10][1]="EmployeeID";		
		//tc_basicpayroll
		$this->ArrTable[11][0]="timecardx06.tc_basicpayroll";
		$this->ArrTable[11][1]="EmployeeID";		
		//tc_costemployee
		$this->ArrTable[12][0]="timecardx06.tc_costemployee";
		$this->ArrTable[12][1]="EmployeeID";		
		//tc_employeerest
		$this->ArrTable[13][0]="timecardx06.tc_employeerest";
		$this->ArrTable[13][1]="EmployeeID";		
		//hr_empchildren
		$this->ArrTable[14][0]="hr_empchildren";
		$this->ArrTable[14][1]="EmployeeID";		
		//hr_empdependents
		$this->ArrTable[15][0]="hr_empdependents";
		$this->ArrTable[15][1]="EmployeeID";		
		//hr_emplanguage
		$this->ArrTable[16][0]="hr_emplanguage";
		$this->ArrTable[16][1]="EmployeeID";		
		//hr_empskill
		$this->ArrTable[17][0]="hr_empskill";
		$this->ArrTable[17][1]="EmployeeID";		
		//hr_emplicense
		$this->ArrTable[18][0]="hr_emplicense";
		$this->ArrTable[18][1]="EmployeeID";		
		//hr_empmembership
		$this->ArrTable[19][0]="hr_empmembership";
		$this->ArrTable[19][1]="EmployeeID";		
		//hr_emppassport
		$this->ArrTable[20][0]="hr_emppassport";
		$this->ArrTable[20][1]="EmployeeID";		
		//hr_empbasicsalary
		$this->ArrTable[21][0]="hr_empbasicsalary";
		$this->ArrTable[21][1]="EmployeeID";		
		//hr_empemergencycontact
		$this->ArrTable[22][0]="hr_empemergencycontact";
		$this->ArrTable[22][1]="EmployeeID";		
		//hr_empexperience
		$this->ArrTable[23][0]="hr_empexperience";
		$this->ArrTable[23][1]="EmployeeID";		
		//hr_empeducation
		$this->ArrTable[24][0]="hr_empeducation";
		$this->ArrTable[24][1]="EmployeeID";		
		//hr_documents
		$this->ArrTable[25][0]="hr_documents";
		$this->ArrTable[25][1]="LinkID";		
		//hr_empperformances
		$this->ArrTable[26][0]="hr_empperformances";
		$this->ArrTable[26][1]="EmployeeID";		
		//hr_empcontract
		$this->ArrTable[27][0]="hr_empcontract";
		$this->ArrTable[27][1]="EmployeeID";		
		//hr_buildcontract
		$this->ArrTable[28][0]="hr_buildcontract";
		$this->ArrTable[28][1]="EmployeeID";			
		//emp_personal
		$this->ArrTable[29][0]="emp_personal";
		$this->ArrTable[29][1]="ID";		
		//emp_contact
		$this->ArrTable[30][0]="emp_contact";
		$this->ArrTable[30][1]="ID";
		$this->ArrTable[30][2]="1";				
		//emp_job
		$this->ArrTable[31][0]="emp_job";
		$this->ArrTable[31][1]="ID";		
		//Messages
		$this->ArrTable[32][0]="messages";
		$this->ArrTable[32][1]="UserID";		
		//LogEmp
		$this->ArrTable[33][0]="logemp";
		$this->ArrTable[33][1]="EmployeeID";				
		//employees
		$this->ArrTable[34][0]="employees";
		$this->ArrTable[34][1]="ID";				
		$this->Count=count($this->ArrTable);
		//hr_empinssurancerpt
		$this->ArrTable[35][0]="hr_empinssurancerpt";
		$this->ArrTable[35][1]="EmployeeID";				
		$this->Count=count($this->ArrTable);
		//employees
		$this->ArrTable[36][0]="hr_parainssurance";
		$this->ArrTable[36][1]="EmployeeID";				
		$this->Count=count($this->ArrTable);		
		
	}
//Hàm gọi thực thi chuyển mã nhân viên sang mã khác	
	function IdChangeEmployees($vEmployeeID,$vDate)
	{
		$this->Finish="";
		$this->Error="";
		$NewID=$vEmployeeID.$this->GetStringDate($vDate);
		
		if($this->Exist($NewID)>0)
		{
			$this->Error="NewID is exist!You contract with admin";
		}
		else
		{
			for ($i=0;$i<$this->Count;$i++)
			{
				if($this->SQLChange($this->ArrTable[$i][0],$this->ArrTable[$i][1],$vEmployeeID,$NewID))
				{
					$this->Finish=$this->Finish.$this->ArrTable[$i][0];//Đổi bảng thành công
				}
				else
				{
					$this->Error=$this->Error.$this->ArrTable[$i][0];//Đổi bảng thất bại
				}
				
			}
			$this->DelFlag($NewID,1);
		}
	}
//Hàm lấy chuổi ngày tháng năm liền nhau
	function GetStringDate($vDate)
	{
		return( getyear($vDate).getmonth($vDate).getday($vDate));
	}
//Hàm thực thi chuyển đổi mã nhân viên	
	function SQLChange($vTable,$vCol,$vEmployeeOldID,$vEmployeeNewID)
	{
		 $vsql="update $vTable Set $vCol='$vEmployeeNewID' where $vCol='$vEmployeeOldID'";
		return db_query($vsql);
	}
//Hàm xóa nhân viên trong cơ sở dữ liệu 	
	function IdDeleteEmployees($vEmployeeID)
	{
		$this->Finish="";
		$this->Error="";
		for ($i=0;$i<$this->Count;$i++)
		{
			if((int)$this->ArrTable[$i][2]>0)  $this->ControlException($vEmployeeID,(int)$this->ArrTable[$i][2]);
			if($this->SQLDelete($this->ArrTable[$i][0],$this->ArrTable[$i][1],$vEmployeeID))
			{
				$this->Finish=$this->Finish."|".$this->ArrTable[$i][0];//Đổi bảng thành công
			}
			else
			{
				$this->Error=$this->Error."|".$this->ArrTable[$i][0];//Đổi bảng thất bại
			}
			
		}
	}
	//Hàm xóa 
	function SQLDelete($vTable,$vCol,$vEmployeeID)
	{
		$vsql="Delete FROM $vTable where $vCol='$vEmployeeID'";
		return db_query($vsql);
	}
//Hàm điều khiển xóa ngoại lệ
	function ControlException($vExp,$vEmployeeID)
	{
		switch($vExp)
		{
			case 1://Delete hr_buildcontract
				if($this->hr_buildcontractDel($vEmployeeID))
					$this->Finish=$this->Finish."|"."hrbuildcontract";
				else
					$this->Finish=$this->Finish."|"."hrbuildcontract";
				break;
			case 2://Delete tc_timesheetdetailDel
				if($this->tc_timesheetdetailDel($vEmployeeID))
					$this->Finish=$this->Finish."|"."tc_timesheetdetailDel";
				else
					$this->Finish=$this->Finish."|"."tc_timesheetdetailDel";		
				break;			
			case 3://Delete tc_loanpayment
				if($this->tc_loanpaymentDel($vEmployeeID))
					$this->Finish=$this->Finish."|"."tc_loanpayment";
				else
					$this->Finish=$this->Finish."|"."tc_loanpayment";				
				break;			
		}
	}	
//Xóa bên HR	
	function hr_buildcontractDel($vEmployeeID)
	{
		$vsql="delete hr_buildcontract where EmpContractID in (select B.ID from hr_empcontract B where B.EmployeeID='$vEmployeeID')";
		return ($vsql);
	} 
//Xóa bên TC
	function tc_timesheetdetailDel($vEmployeeID)
	{
		$vsql="delete timecardx06.tc_timesheetdetail where TimesheetID in (select B.ID from tc_timesheet B where B.EmployeeID='$vEmployeeID')";
		return ($vsql);
		
	}
	function tc_loanpaymentDel($vEmployeeID)
	{
		$vsql="delete timecardx06.tc_loanpayment where LoanID in (select B.ID from tc_loan B where B.EmployeeID='$vEmployeeID')";
		return ($vsql);
		
	}
//Kiểm tra tồn tại	
	function Exist($vEmployeeID)
	{
		$vsql="select ID from employees where ID='".$vEmployeeID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
//Hàm bật cờ chuyển nhân viên vào trạng thái xóa
	function DelFlag($vEmployeeID,$vFlag)
	{
		$vsql="Update employees set Del='$vFlag' where ID='$vEmployeeID'";
		return db_query($vsql);
	}		
}
?>