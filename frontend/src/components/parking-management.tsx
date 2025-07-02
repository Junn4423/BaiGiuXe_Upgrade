// "use client"

// import { useState, useEffect } from "react"
// import { Button } from "@/components/ui/button"
// import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
// import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog"
// import { Input } from "@/components/ui/input"
// import { Label } from "@/components/ui/label"
// import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
// import { Badge } from "@/components/ui/badge"
// import { Textarea } from "@/components/ui/textarea"
// import { Calendar, Clock, Car, MapPin, Filter, Search, Plus, Trash2 } from "lucide-react"

// // Types
// interface ParkingSpot {
//   id: string
//   position: string
//   status: "occupied" | "reserved" | "available"
//   licensePlate?: string
//   customerName?: string
//   phoneNumber?: string
//   entryTime?: string
//   exitTime?: string
//   reservationTime?: string
//   notes?: string
//   area: string
// }

// interface Area {
//   id: string
//   name: string
//   totalSpots: number
// }

// // Mock data
// const initialAreas: Area[] = [
//   { id: "area-a", name: "Khu A - Tầng 1", totalSpots: 50 },
//   { id: "area-b", name: "Khu B - Tầng 1", totalSpots: 40 },
//   { id: "area-c", name: "Khu C - Tầng 2", totalSpots: 60 },
//   { id: "area-d", name: "Khu D - Tầng 2", totalSpots: 45 },
// ]

// const generateInitialSpots = (areas: Area[]): ParkingSpot[] => {
//   const spots: ParkingSpot[] = []
//   areas.forEach((area) => {
//     for (let i = 1; i <= area.totalSpots; i++) {
//       const spotNumber = i.toString().padStart(2, "0")
//       const random = Math.random()
//       let status: ParkingSpot["status"] = "available"
//       let licensePlate = undefined
//       let customerName = undefined
//       let entryTime = undefined
//       let reservationTime = undefined

//       if (random < 0.3) {
//         status = "occupied"
//         licensePlate = `${Math.random() > 0.5 ? "HN" : "SG"}-${Math.floor(Math.random() * 9000) + 1000}`
//         customerName = `Khách hàng ${i}`
//         entryTime = new Date(Date.now() - Math.random() * 4 * 60 * 60 * 1000).toLocaleString("vi-VN")
//       } else if (random < 0.5) {
//         status = "reserved"
//         licensePlate = `${Math.random() > 0.5 ? "HN" : "SG"}-${Math.floor(Math.random() * 9000) + 1000}`
//         customerName = `Khách đặt ${i}`
//         reservationTime = new Date(Date.now() + Math.random() * 2 * 60 * 60 * 1000).toLocaleString("vi-VN")
//       }

//       spots.push({
//         id: `${area.id}-${spotNumber}`,
//         position: `${area.name.split(" - ")[0]}-${spotNumber}`,
//         status,
//         licensePlate,
//         customerName,
//         entryTime,
//         reservationTime,
//         area: area.id,
//         phoneNumber:
//           status !== "available"
//             ? `09${Math.floor(Math.random() * 100000000)
//                 .toString()
//                 .padStart(8, "0")}`
//             : undefined,
//       })
//     }
//   })
//   return spots
// }

// export default function ParkingManagement() {
//   const [areas] = useState<Area[]>(initialAreas)
//   const [parkingSpots, setParkingSpots] = useState<ParkingSpot[]>([])
//   const [selectedArea, setSelectedArea] = useState<string>(areas[0]?.id || "")
//   const [selectedSpot, setSelectedSpot] = useState<ParkingSpot | null>(null)
//   const [isDialogOpen, setIsDialogOpen] = useState(false)
//   const [filterStatus, setFilterStatus] = useState<string>("all")
//   const [searchTerm, setSearchTerm] = useState("")
//   const [editMode, setEditMode] = useState<"view" | "assign" | "reserve">("view")

//   useEffect(() => {
//     setParkingSpots(generateInitialSpots(areas))
//   }, [areas])

//   const currentArea = areas.find((area) => area.id === selectedArea)
//   const filteredSpots = parkingSpots
//     .filter((spot) => spot.area === selectedArea)
//     .filter((spot) => {
//       if (filterStatus === "all") return true
//       return spot.status === filterStatus
//     })
//     .filter((spot) => {
//       if (!searchTerm) return true
//       return (
//         spot.position.toLowerCase().includes(searchTerm.toLowerCase()) ||
//         spot.licensePlate?.toLowerCase().includes(searchTerm.toLowerCase()) ||
//         spot.customerName?.toLowerCase().includes(searchTerm.toLowerCase())
//       )
//     })

//   const getSpotColor = (status: ParkingSpot["status"]) => {
//     switch (status) {
//       case "occupied":
//         return "bg-red-500 hover:bg-red-600"
//       case "reserved":
//         return "bg-yellow-500 hover:bg-yellow-600"
//       case "available":
//         return "bg-green-500 hover:bg-green-600"
//       default:
//         return "bg-gray-500"
//     }
//   }

//   const getStatusText = (status: ParkingSpot["status"]) => {
//     switch (status) {
//       case "occupied":
//         return "Đang đỗ"
//       case "reserved":
//         return "Đã đặt"
//       case "available":
//         return "Trống"
//       default:
//         return "Không xác định"
//     }
//   }

//   const getStatusBadgeColor = (status: ParkingSpot["status"]) => {
//     switch (status) {
//       case "occupied":
//         return "bg-red-100 text-red-800"
//       case "reserved":
//         return "bg-yellow-100 text-yellow-800"
//       case "available":
//         return "bg-green-100 text-green-800"
//       default:
//         return "bg-gray-100 text-gray-800"
//     }
//   }

//   const handleSpotClick = (spot: ParkingSpot) => {
//     setSelectedSpot(spot)
//     setEditMode("view")
//     setIsDialogOpen(true)
//   }

//   const handleAssignSpot = () => {
//     if (!selectedSpot) return

//     const updatedSpots = parkingSpots.map((spot) => {
//       if (spot.id === selectedSpot.id) {
//         return {
//           ...spot,
//           status: "occupied" as const,
//           entryTime: new Date().toLocaleString("vi-VN"),
//           reservationTime: undefined,
//         }
//       }
//       return spot
//     })

//     setParkingSpots(updatedSpots)
//     setSelectedSpot({ ...selectedSpot, status: "occupied", entryTime: new Date().toLocaleString("vi-VN") })
//   }

//   const handleReserveSpot = () => {
//     if (!selectedSpot) return

//     const updatedSpots = parkingSpots.map((spot) => {
//       if (spot.id === selectedSpot.id) {
//         return {
//           ...spot,
//           status: "reserved" as const,
//           reservationTime: new Date().toLocaleString("vi-VN"),
//           entryTime: undefined,
//         }
//       }
//       return spot
//     })

//     setParkingSpots(updatedSpots)
//     setSelectedSpot({ ...selectedSpot, status: "reserved", reservationTime: new Date().toLocaleString("vi-VN") })
//   }

//   const handleReleaseSpot = () => {
//     if (!selectedSpot) return

//     const updatedSpots = parkingSpots.map((spot) => {
//       if (spot.id === selectedSpot.id) {
//         return {
//           ...spot,
//           status: "available" as const,
//           licensePlate: undefined,
//           customerName: undefined,
//           phoneNumber: undefined,
//           entryTime: undefined,
//           exitTime: new Date().toLocaleString("vi-VN"),
//           reservationTime: undefined,
//           notes: undefined,
//         }
//       }
//       return spot
//     })

//     setParkingSpots(updatedSpots)
//     setIsDialogOpen(false)
//   }

//   const updateSpotInfo = (updates: Partial<ParkingSpot>) => {
//     if (!selectedSpot) return

//     const updatedSpot = { ...selectedSpot, ...updates }
//     const updatedSpots = parkingSpots.map((spot) => (spot.id === selectedSpot.id ? updatedSpot : spot))

//     setParkingSpots(updatedSpots)
//     setSelectedSpot(updatedSpot)
//   }

//   const getAreaStats = () => {
//     const areaSpots = parkingSpots.filter((spot) => spot.area === selectedArea)
//     const occupied = areaSpots.filter((spot) => spot.status === "occupied").length
//     const reserved = areaSpots.filter((spot) => spot.status === "reserved").length
//     const available = areaSpots.filter((spot) => spot.status === "available").length

//     return { occupied, reserved, available, total: areaSpots.length }
//   }

//   const stats = getAreaStats()

//   return (
//     <div className="min-h-screen bg-gray-50 p-6">
//       <div className="max-w-7xl mx-auto space-y-6">
//         {/* Header */}
//         <div className="flex items-center justify-between">
//           <div>
//             <h1 className="text-3xl font-bold text-gray-900">Quản lý bãi đỗ xe</h1>
//             <p className="text-gray-600 mt-1">Hệ thống quản lý vị trí đỗ xe ô tô</p>
//           </div>
//           <div className="flex items-center gap-4">
//             <Badge variant="outline" className="text-sm">
//               <Clock className="w-4 h-4 mr-1" />
//               {new Date().toLocaleString("vi-VN")}
//             </Badge>
//           </div>
//         </div>

//         {/* Controls */}
//         <Card>
//           <CardContent className="p-6">
//             <div className="flex flex-wrap items-center gap-4">
//               {/* Area Selection */}
//               <div className="flex items-center gap-2">
//                 <MapPin className="w-4 h-4 text-gray-500" />
//                 <Label htmlFor="area-select">Khu vực:</Label>
//                 <Select value={selectedArea} onValueChange={setSelectedArea}>
//                   <SelectTrigger className="w-48">
//                     <SelectValue placeholder="Chọn khu vực" />
//                   </SelectTrigger>
//                   <SelectContent>
//                     {areas.map((area) => (
//                       <SelectItem key={area.id} value={area.id}>
//                         {area.name}
//                       </SelectItem>
//                     ))}
//                   </SelectContent>
//                 </Select>
//               </div>

//               {/* Status Filter */}
//               <div className="flex items-center gap-2">
//                 <Filter className="w-4 h-4 text-gray-500" />
//                 <Label htmlFor="status-filter">Trạng thái:</Label>
//                 <Select value={filterStatus} onValueChange={setFilterStatus}>
//                   <SelectTrigger className="w-40">
//                     <SelectValue />
//                   </SelectTrigger>
//                   <SelectContent>
//                     <SelectItem value="all">Tất cả</SelectItem>
//                     <SelectItem value="available">Trống</SelectItem>
//                     <SelectItem value="occupied">Đang đỗ</SelectItem>
//                     <SelectItem value="reserved">Đã đặt</SelectItem>
//                   </SelectContent>
//                 </Select>
//               </div>

//               {/* Search */}
//               <div className="flex items-center gap-2">
//                 <Search className="w-4 h-4 text-gray-500" />
//                 <Input
//                   placeholder="Tìm kiếm vị trí, biển số..."
//                   value={searchTerm}
//                   onChange={(e) => setSearchTerm(e.target.value)}
//                   className="w-64"
//                 />
//               </div>
//             </div>
//           </CardContent>
//         </Card>

//         {/* Statistics */}
//         <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
//           <Card>
//             <CardContent className="p-4">
//               <div className="flex items-center justify-between">
//                 <div>
//                   <p className="text-sm text-gray-600">Tổng vị trí</p>
//                   <p className="text-2xl font-bold">{stats.total}</p>
//                 </div>
//                 <Car className="w-8 h-8 text-blue-500" />
//               </div>
//             </CardContent>
//           </Card>

//           <Card>
//             <CardContent className="p-4">
//               <div className="flex items-center justify-between">
//                 <div>
//                   <p className="text-sm text-gray-600">Đang đỗ</p>
//                   <p className="text-2xl font-bold text-red-600">{stats.occupied}</p>
//                 </div>
//                 <div className="w-8 h-8 bg-red-500 rounded"></div>
//               </div>
//             </CardContent>
//           </Card>

//           <Card>
//             <CardContent className="p-4">
//               <div className="flex items-center justify-between">
//                 <div>
//                   <p className="text-sm text-gray-600">Đã đặt</p>
//                   <p className="text-2xl font-bold text-yellow-600">{stats.reserved}</p>
//                 </div>
//                 <div className="w-8 h-8 bg-yellow-500 rounded"></div>
//               </div>
//             </CardContent>
//           </Card>

//           <Card>
//             <CardContent className="p-4">
//               <div className="flex items-center justify-between">
//                 <div>
//                   <p className="text-sm text-gray-600">Trống</p>
//                   <p className="text-2xl font-bold text-green-600">{stats.available}</p>
//                 </div>
//                 <div className="w-8 h-8 bg-green-500 rounded"></div>
//               </div>
//             </CardContent>
//           </Card>
//         </div>

//         {/* Parking Grid */}
//         <Card>
//           <CardHeader>
//             <CardTitle className="flex items-center gap-2">
//               <MapPin className="w-5 h-5" />
//               {currentArea?.name} - Sơ đồ bãi đỗ xe
//             </CardTitle>
//           </CardHeader>
//           <CardContent className="p-6">
//             <div className="bg-gray-100 p-6 rounded-lg">
//               {/* Entrance/Exit Labels */}
//               <div className="flex justify-between items-center mb-4">
//                 <Badge variant="outline" className="bg-blue-100 text-blue-800">
//                   🚪 Lối vào
//                 </Badge>
//                 <Badge variant="outline" className="bg-blue-100 text-blue-800">
//                   Lối ra 🚪
//                 </Badge>
//               </div>

//               {/* Main Parking Layout */}
//               <div className="space-y-6">
//                 {/* Top Section - Rows A & B */}
//                 <div className="space-y-4">
//                   <div className="text-center">
//                     <Badge variant="secondary">Khu vực A</Badge>
//                   </div>

//                   {/* Row A1 */}
//                   <div className="flex justify-center">
//                     <div className="grid grid-cols-12 gap-1">
//                       {filteredSpots.slice(0, 12).map((spot) => (
//                         <ParkingSpotButton key={spot.id} spot={spot} onSpotClick={handleSpotClick} />
//                       ))}
//                     </div>
//                   </div>

//                   {/* Driving Lane */}
//                   <div className="h-8 bg-gray-300 rounded flex items-center justify-center">
//                     <span className="text-xs text-gray-600">← Lối đi →</span>
//                   </div>

//                   {/* Row A2 */}
//                   <div className="flex justify-center">
//                     <div className="grid grid-cols-12 gap-1">
//                       {filteredSpots.slice(12, 24).map((spot) => (
//                         <ParkingSpotButton key={spot.id} spot={spot} onSpotClick={handleSpotClick} />
//                       ))}
//                     </div>
//                   </div>
//                 </div>

//                 {/* Middle Section - Main Driving Area */}
//                 <div className="h-12 bg-gray-200 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-400">
//                   <div className="flex items-center gap-4">
//                     <span className="text-sm text-gray-600">🚗 Khu vực di chuyển chính</span>
//                     <div className="flex gap-2">
//                       <div className="w-2 h-2 bg-gray-400 rounded-full"></div>
//                       <div className="w-2 h-2 bg-gray-400 rounded-full"></div>
//                       <div className="w-2 h-2 bg-gray-400 rounded-full"></div>
//                     </div>
//                   </div>
//                 </div>

//                 {/* Bottom Left Section - Rows C */}
//                 <div className="grid grid-cols-2 gap-8">
//                   <div className="space-y-4">
//                     <div className="text-center">
//                       <Badge variant="secondary">Khu vực B</Badge>
//                     </div>

//                     {/* Vertical parking spots */}
//                     <div className="space-y-2">
//                       {Array.from({ length: 3 }, (_, rowIndex) => (
//                         <div key={rowIndex} className="flex gap-1">
//                           <div className="grid grid-cols-6 gap-1">
//                             {filteredSpots.slice(24 + rowIndex * 6, 24 + (rowIndex + 1) * 6).map((spot) => (
//                               <ParkingSpotButton key={spot.id} spot={spot} onSpotClick={handleSpotClick} />
//                             ))}
//                           </div>
//                           {rowIndex < 2 && (
//                             <div className="w-6 bg-gray-300 rounded flex items-center justify-center">
//                               <span className="text-xs text-gray-600 transform -rotate-90">↕</span>
//                             </div>
//                           )}
//                         </div>
//                       ))}
//                     </div>
//                   </div>

//                   {/* Bottom Right Section - Rows D */}
//                   <div className="space-y-4">
//                     <div className="text-center">
//                       <Badge variant="secondary">Khu vực C</Badge>
//                     </div>

//                     {/* Vertical parking spots */}
//                     <div className="space-y-2">
//                       {Array.from({ length: 3 }, (_, rowIndex) => (
//                         <div key={rowIndex} className="flex gap-1">
//                           <div className="grid grid-cols-6 gap-1">
//                             {filteredSpots.slice(42 + rowIndex * 6, 42 + (rowIndex + 1) * 6).map((spot) => (
//                               <ParkingSpotButton key={spot.id} spot={spot} onSpotClick={handleSpotClick} />
//                             ))}
//                           </div>
//                           {rowIndex < 2 && (
//                             <div className="w-6 bg-gray-300 rounded flex items-center justify-center">
//                               <span className="text-xs text-gray-600 transform -rotate-90">↕</span>
//                             </div>
//                           )}
//                         </div>
//                       ))}
//                     </div>
//                   </div>
//                 </div>

//                 {/* Bottom Section - Additional Rows */}
//                 {filteredSpots.length > 60 && (
//                   <div className="space-y-4">
//                     <div className="h-6 bg-gray-300 rounded flex items-center justify-center">
//                       <span className="text-xs text-gray-600">← Lối đi →</span>
//                     </div>

//                     <div className="text-center">
//                       <Badge variant="secondary">Khu vực D</Badge>
//                     </div>

//                     <div className="flex justify-center">
//                       <div className="grid grid-cols-10 gap-1">
//                         {filteredSpots.slice(60).map((spot) => (
//                           <ParkingSpotButton key={spot.id} spot={spot} onSpotClick={handleSpotClick} />
//                         ))}
//                       </div>
//                     </div>
//                   </div>
//                 )}
//               </div>

//               {/* Legend */}
//               <div className="flex items-center justify-center gap-6 mt-8 pt-6 border-t border-gray-300">
//                 <div className="flex items-center gap-2">
//                   <div className="w-4 h-4 bg-green-500 rounded"></div>
//                   <span className="text-sm">Trống ({stats.available})</span>
//                 </div>
//                 <div className="flex items-center gap-2">
//                   <div className="w-4 h-4 bg-yellow-500 rounded"></div>
//                   <span className="text-sm">Đã đặt ({stats.reserved})</span>
//                 </div>
//                 <div className="flex items-center gap-2">
//                   <div className="w-4 h-4 bg-red-500 rounded"></div>
//                   <span className="text-sm">Đang đỗ ({stats.occupied})</span>
//                 </div>
//                 <div className="flex items-center gap-2">
//                   <div className="w-4 h-4 bg-gray-300 rounded"></div>
//                   <span className="text-sm">Lối đi</span>
//                 </div>
//               </div>
//             </div>
//           </CardContent>
//         </Card>

//         {/* Spot Details Dialog */}
//         <Dialog open={isDialogOpen} onOpenChange={setIsDialogOpen}>
//           <DialogContent className="max-w-2xl">
//             <DialogHeader>
//               <DialogTitle className="flex items-center gap-2">
//                 <Car className="w-5 h-5" />
//                 Thông tin vị trí {selectedSpot?.position}
//               </DialogTitle>
//             </DialogHeader>

//             {selectedSpot && (
//               <div className="space-y-6">
//                 {/* Status Badge */}
//                 <div className="flex items-center gap-4">
//                   <Badge className={getStatusBadgeColor(selectedSpot.status)}>
//                     {getStatusText(selectedSpot.status)}
//                   </Badge>
//                   <span className="text-sm text-gray-500">Vị trí: {selectedSpot.position}</span>
//                 </div>

//                 {/* Mode Selection */}
//                 <div className="flex gap-2">
//                   <Button
//                     variant={editMode === "view" ? "default" : "outline"}
//                     size="sm"
//                     onClick={() => setEditMode("view")}
//                   >
//                     Xem thông tin
//                   </Button>
//                   {selectedSpot.status === "available" && (
//                     <>
//                       <Button
//                         variant={editMode === "assign" ? "default" : "outline"}
//                         size="sm"
//                         onClick={() => setEditMode("assign")}
//                       >
//                         Chỉ định xe
//                       </Button>
//                       <Button
//                         variant={editMode === "reserve" ? "default" : "outline"}
//                         size="sm"
//                         onClick={() => setEditMode("reserve")}
//                       >
//                         Đặt chỗ
//                       </Button>
//                     </>
//                   )}
//                 </div>

//                 {/* Content based on mode */}
//                 {editMode === "view" && (
//                   <div className="grid grid-cols-2 gap-4">
//                     <div>
//                       <Label>Biển số xe</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.licensePlate || "Chưa có"}</p>
//                     </div>
//                     <div>
//                       <Label>Tên khách hàng</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.customerName || "Chưa có"}</p>
//                     </div>
//                     <div>
//                       <Label>Số điện thoại</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.phoneNumber || "Chưa có"}</p>
//                     </div>
//                     <div>
//                       <Label>Thời gian vào</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.entryTime || "Chưa có"}</p>
//                     </div>
//                     <div>
//                       <Label>Thời gian đặt</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.reservationTime || "Chưa có"}</p>
//                     </div>
//                     <div className="col-span-2">
//                       <Label>Ghi chú</Label>
//                       <p className="text-sm text-gray-600 mt-1">{selectedSpot.notes || "Không có ghi chú"}</p>
//                     </div>
//                   </div>
//                 )}

//                 {(editMode === "assign" || editMode === "reserve") && (
//                   <div className="space-y-4">
//                     <div className="grid grid-cols-2 gap-4">
//                       <div>
//                         <Label htmlFor="licensePlate">Biển số xe *</Label>
//                         <Input
//                           id="licensePlate"
//                           value={selectedSpot.licensePlate || ""}
//                           onChange={(e) => updateSpotInfo({ licensePlate: e.target.value })}
//                           placeholder="VD: 30A-12345"
//                         />
//                       </div>
//                       <div>
//                         <Label htmlFor="customerName">Tên khách hàng *</Label>
//                         <Input
//                           id="customerName"
//                           value={selectedSpot.customerName || ""}
//                           onChange={(e) => updateSpotInfo({ customerName: e.target.value })}
//                           placeholder="Nhập tên khách hàng"
//                         />
//                       </div>
//                     </div>
//                     <div>
//                       <Label htmlFor="phoneNumber">Số điện thoại</Label>
//                       <Input
//                         id="phoneNumber"
//                         value={selectedSpot.phoneNumber || ""}
//                         onChange={(e) => updateSpotInfo({ phoneNumber: e.target.value })}
//                         placeholder="Nhập số điện thoại"
//                       />
//                     </div>
//                     <div>
//                       <Label htmlFor="notes">Ghi chú</Label>
//                       <Textarea
//                         id="notes"
//                         value={selectedSpot.notes || ""}
//                         onChange={(e) => updateSpotInfo({ notes: e.target.value })}
//                         placeholder="Nhập ghi chú (tùy chọn)"
//                         rows={3}
//                       />
//                     </div>
//                   </div>
//                 )}

//                 {/* Action Buttons */}
//                 <div className="flex justify-between pt-4 border-t">
//                   <div>
//                     {selectedSpot.status !== "available" && (
//                       <Button variant="destructive" onClick={handleReleaseSpot} className="flex items-center gap-2">
//                         <Trash2 className="w-4 h-4" />
//                         Giải phóng vị trí
//                       </Button>
//                     )}
//                   </div>

//                   <div className="flex gap-2">
//                     <Button variant="outline" onClick={() => setIsDialogOpen(false)}>
//                       Đóng
//                     </Button>

//                     {editMode === "assign" && (
//                       <Button
//                         onClick={handleAssignSpot}
//                         disabled={!selectedSpot.licensePlate || !selectedSpot.customerName}
//                         className="flex items-center gap-2"
//                       >
//                         <Plus className="w-4 h-4" />
//                         Chỉ định vị trí
//                       </Button>
//                     )}

//                     {editMode === "reserve" && (
//                       <Button
//                         onClick={handleReserveSpot}
//                         disabled={!selectedSpot.licensePlate || !selectedSpot.customerName}
//                         className="flex items-center gap-2"
//                       >
//                         <Calendar className="w-4 h-4" />
//                         Đặt chỗ
//                       </Button>
//                     )}
//                   </div>
//                 </div>
//               </div>
//             )}
//           </DialogContent>
//         </Dialog>
//       </div>
//     </div>
//   )
// }

// // Parking Spot Button Component
// function ParkingSpotButton({
//   spot,
//   onSpotClick,
// }: {
//   spot: ParkingSpot
//   onSpotClick: (spot: ParkingSpot) => void
// }) {
//   const getSpotColor = (status: ParkingSpot["status"]) => {
//     switch (status) {
//       case "occupied":
//         return "bg-red-500 hover:bg-red-600 shadow-red-200"
//       case "reserved":
//         return "bg-yellow-500 hover:bg-yellow-600 shadow-yellow-200"
//       case "available":
//         return "bg-green-500 hover:bg-green-600 shadow-green-200"
//       default:
//         return "bg-gray-500 shadow-gray-200"
//     }
//   }

//   const getStatusIcon = (status: ParkingSpot["status"]) => {
//     switch (status) {
//       case "occupied":
//         return "🚗"
//       case "reserved":
//         return "🅿️"
//       case "available":
//         return ""
//       default:
//         return ""
//     }
//   }

//   return (
//     <button
//       onClick={() => onSpotClick(spot)}
//       className={`
//         relative w-12 h-16 rounded-lg text-white font-semibold text-xs
//         transition-all duration-200 transform hover:scale-105 hover:shadow-lg
//         flex flex-col items-center justify-center gap-1 border-2 border-white
//         ${getSpotColor(spot.status)}
//       `}
//       title={`${spot.position} - ${getStatusText(spot.status)}${spot.licensePlate ? ` - ${spot.licensePlate}` : ""}`}
//     >
//       <span className="text-xs">{getStatusIcon(spot.status)}</span>
//       <span className="text-xs font-bold">{spot.position.split("-")[1]}</span>
//       {spot.licensePlate && (
//         <span className="absolute -bottom-1 left-0 right-0 text-[8px] bg-black bg-opacity-50 rounded-b px-1 truncate">
//           {spot.licensePlate.split("-")[1]}
//         </span>
//       )}
//     </button>
//   )
// }

// function getStatusText(status: ParkingSpot["status"]) {
//   switch (status) {
//     case "occupied":
//       return "Đang đỗ"
//     case "reserved":
//       return "Đã đặt"
//     case "available":
//       return "Trống"
//     default:
//       return "Không xác định"
//   }
// }
