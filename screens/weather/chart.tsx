import React, { useState, useContext } from "react";
import { Box } from "@/components/ui/box";
import { HStack } from "@/components/ui/hstack";
import { VStack } from "@/components/ui/vstack";
import { Text } from "@/components/ui/text";
import { CalendarDaysIcon, Icon } from "@/components/ui/icon";
import { Dimensions } from "react-native";
import { Dataset } from "react-native-chart-kit/dist/HelperTypes";
import { LineChart } from "react-native-chart-kit";
import { ColorModeContext } from "@/app/_layout";

interface DataPoint {
  index: number;
  value: number;
  dataset: Dataset;
  x: number;
  y: number;
  getColor: (opacity: number) => string;
}

const Chart = () => {
  const { colorMode }: any = useContext(ColorModeContext);
  const [selectedDataPoint, setSelectedDataPoint] = useState<DataPoint | null>(
    null
  );
  const screenWidth = Dimensions.get("window").width;
  const dataPointClick = (data: DataPoint) => {
    setSelectedDataPoint(data);
  };
  return (
    <VStack className="py-3 rounded-[18px] bg-background-100" space="md">
      <HStack space="sm" className="px-3 items-center">
        <Box className="h-8 w-8 bg-background-50 items-center justify-center rounded-full">
          <Icon as={CalendarDaysIcon} className="text-background-800" />
        </Box>
        <Text className="font-medium">Day forecast</Text>
      </HStack>

      <Box className="relative">
        <LineChart
          data={{
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [
              {
                data: [-6, -1, -3, 3, 1, -2, 2],
              },
            ],
          }}
          width={screenWidth - 56}
          height={220}
          bezier
          yAxisSuffix="°" // Adds degree symbol
          onDataPointClick={dataPointClick}
          withVerticalLines={false}
          chartConfig={{
            backgroundGradientFrom:
              colorMode === "light" ? "#F1EBFF" : "#1C1A20",
            backgroundGradientTo: colorMode === "light" ? "#F1EBFF" : "#1C1A20",
            decimalPlaces: 0,
            color: (opacity = 1) =>
              colorMode === "light"
                ? `rgba(152, 115, 178, ${opacity})`
                : `rgba(211, 186, 229, ${opacity})`,
            labelColor: (opacity = 1) =>
              colorMode === "light"
                ? `rgba(38, 38, 39, ${opacity})`
                : `rgba(245, 245, 245, ${opacity})`,
            // Add these properties for gradient under the graph line
            fillShadowGradient: colorMode === "light" ? "#9873B2" : "#D3BAE5",
            fillShadowGradientOpacity: 0.8,
            fillShadowGradientTo: colorMode === "light" ? "#F8F4FB" : "#30203C",
            propsForBackgroundLines: {
              strokeDasharray: "",
              stroke: colorMode === "light" ? "#E6E6E6" : "#414141",
              strokeWidth: 1,
            },
            propsForDots: {
              r: "0.5",
              fill:
                colorMode === "light"
                  ? `rgba(152, 115, 178, 0.2)`
                  : `rgba(211, 186, 229, 0.2)`,
            },
          }}
        />

        {selectedDataPoint && (
          <VStack
            className="absolute rounded-full bg-background-50 px-3 py-0.5"
            style={{
              top: selectedDataPoint.y - 35,
              left: selectedDataPoint.x - 17,
            }}
          >
            <Text size="sm" className="text-typography-950">
              {selectedDataPoint.value}°
            </Text>
          </VStack>
        )}

        {selectedDataPoint && (
          <VStack
            className="absolute rounded-full border-2 border-background-50 bg-secondary-900 h-3 w-3"
            style={{
              top: selectedDataPoint.y - 7,
              left: selectedDataPoint.x - 5,
            }}
          ></VStack>
        )}

        {selectedDataPoint && (
          <VStack
            className="absolute border-dashed border border-secondary-900"
            style={{
              height: 181 - selectedDataPoint.y,
              top: selectedDataPoint.y,
              left: selectedDataPoint.x,
            }}
          ></VStack>
        )}
      </Box>
    </VStack>
  );
};

export default Chart;
