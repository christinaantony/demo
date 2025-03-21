import React, { useContext } from "react";
import { Calendar } from "react-native-calendars";
import { VStack } from "@/components/ui/vstack";
import { Text } from "@/components/ui/text";
import { Box } from "@/components/ui/box";
import { Image } from "@/components/ui/image";
import { remapProps } from "nativewind";
import { ColorModeContext } from "@/app/_layout";

const sun_array = [3, 4, 19, 20, 21, 27, 29, 30, 31];
const cloud_array = [6, 7, 12, 17, 18, 25, 26, 28];
const rain_array = [2, 14, 15, 16];
const thunder_array = [1, 5, 8, 9, 10, 11, 13, 22, 23, 24];

const Monthly = () => {
  const { colorMode }: any = useContext(ColorModeContext);
  remapProps(Calendar, {
    className: "style",
  });

  const CustomDayComponent = ({ date, state }: any) => {
    return (
      <VStack
        space="sm"
        className={`${state === "disabled" ? "hidden" : ""} items-center`}
      >
        <Box
          className={`h-10 w-10 items-center justify-center ${
            state === "today" ? "bg-primary-800 rounded-lg" : ""
          }`}
        >
          <Text
            className={` ${
              state === "today" ? "text-typography-0" : "text-typography-900"
            }`}
          >
            {date.day}
          </Text>
        </Box>
        {sun_array.includes(date.day) && (
          <Image
            source={require("@/assets/images/sun.png")}
            alt="image"
            size="none"
            className="w-5 h-5"
          />
        )}
        {cloud_array.includes(date.day) && (
          <Image
            source={require("@/assets/images/cloud2.png")}
            alt="image"
            size="none"
            className="w-5 h-4"
          />
        )}
        {rain_array.includes(date.day) && (
          <Image
            source={require("@/assets/images/rain.png")}
            alt="image"
            size="none"
            className="w-5 h-[18px]"
          />
        )}
        {thunder_array.includes(date.day) && (
          <Image
            source={require("@/assets/images/thunder.png")}
            alt="image"
            size="none"
            className="w-5 h-4"
          />
        )}
      </VStack>
    );
  };

  return (
    <Calendar
      className="border border-outline-100 rounded-xl mx-5 mb-5 p-2"
      dayComponent={CustomDayComponent}
      headerStyle={{
        gap: 12,
      }}
      theme={{
        calendarBackground: colorMode === "dark" ? "#121212" : "#FFF",
        textSectionTitleColor: colorMode === "dark" ? "#A9A9A9" : "#9eaab7", //weeks color
        arrowColor: colorMode === "dark" ? "#F2F1F1" : "#414040", //arrow color
        monthTextColor: colorMode === "dark" ? "#F5F5F5" : "#262627", //month text color
        textMonthFontWeight: "bold", //month font weight
        textDayHeaderFontSize: 15, //weeks font size
      }}
    />
  );
};

export default Monthly;
