import { useContext } from "react";
import { Slot } from "expo-router";
import Header from "@/components/screens/weather/header";
import { ScrollView } from "@/components/ui/scroll-view";
import { LinearGradient } from "@/components/ui/linear-gradient";
import Tabs from "@/components/screens/weather/tabs";
import { Box } from "@/components/ui/box";
import { ColorModeContext } from "@/app/_layout";

export default function HomeLayout() {
  const { colorMode }: any = useContext(ColorModeContext);
  return (
    <ScrollView
      className="bg-background-0"
      bounces={false}
      showsVerticalScrollIndicator={false}
    >
      <Header />

      <Tabs />

      <Box className="bg-background-0">
        <LinearGradient
          colors={
            colorMode === "light"
              ? ["#FFFFFF", "#E0B6FF", "#FFFFFF"]
              : ["#080A0B", "#E0B6FF", "#080A0B"]
          }
          start={[0, 0]}
          end={[1, 0]}
          className="h-0.5 mb-3 mx-5"
        />
      </Box>

      <Slot />
      {/* consider it like a {children} */}
    </ScrollView>
  );
}
